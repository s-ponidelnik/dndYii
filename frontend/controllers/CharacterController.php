<?php

namespace frontend\controllers;

use common\models\_Class;
use common\models\CharacterClass;
use common\models\CharacterParty;
use common\models\CharacterSpellPoints;
use common\models\CharacterTalent;
use common\models\CharacterTalentUsed;
use common\models\ClassMagicLevelPoint;
use common\models\ClassTalent;
use common\models\MulticlassMagicLevelPoint;
use Yii;
use common\models\Character;
use backend\models\CharacterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CharacterController implements the CRUD actions for Character model.
 */
class CharacterController extends Controller
{
    public function actionChange_hp()
    {
        $c_id = Yii::$app->request->get('id', null);
        $hp = Yii::$app->request->get('hp', null);
        if (!empty($c_id)) {
            /** @var Character $character */
            $character = Character::find()->where(['id' => $c_id])->one();
            if (is_object($character)) {
                $character->hp = $hp;
                $character->save();
                var_dump($character->getErrors());
            }
        }
    }

    public function action_change_hp()
    {
        $c_id = Yii::$app->request->get('id', null);
        $hp = Yii::$app->request->get('hp', null);
        if (!empty($c_id)) {
            /** @var Character $character */
            $character = Character::find()->where(['id' => $c_id])->one();
            if (is_object($character)) {
                $character->hp = $character->hp + $hp;
                if ($character->save()) {
                    return json_encode(['status' => ['text' => 'OK', 'code' => 200], 'data' => ['character_id'=>$character->id,'hp' => $character->hp]]);

                }
            }
        }
        return json_encode(['status' => ['text' => 'Error', 'code' => 400]]);
    }

    public function getSpellMaxPoints($character_id)
    {
        $points = [];
        $spellPoints = [];
        $classes = [];
        $dt = CharacterClass::find()->where(['character_id' => $character_id])->all();
        /** @var CharacterClass $cClass */
        foreach ($dt as $cClass) {
            if (is_object($cClass->class) && $cClass->class->magic_proficiency_type != _Class::NO_MAGIC) {
                $classes[] = $cClass;
            }
        }
        if (count($classes) == 1) {
            $spellPoints = ClassMagicLevelPoint::getByClassLevel($classes[0]->class_id, $classes[0]->level);
        } elseif (count($classes) > 1) {
            $spellCasterLevel = 0;
            /** @var CharacterClass $class */
            foreach ($classes as $class) {
                $spellCasterLevel += $class->level * $class->class->caster_value;
            }
            $spellCasterLevel = intval($spellCasterLevel);
            $spellPoints = MulticlassMagicLevelPoint::getByLevel($spellCasterLevel);
        }

        /** @var ClassMagicLevelPoint $spellPoint */
        foreach ($spellPoints as $spellPoint) {
            $points[$spellPoint->spell_level] = $spellPoint->spell_point;
        }
        return $points;
    }

    public function actionRest()
    {
        $character_id = Yii::$app->request->get('id', null);
        CharacterSpellPoints::deleteAll(['character_id' => $character_id]);
    }

    public function getUsedSpellPoint($character_id, $level)
    {
        /** @var CharacterSpellPoints $usedPoints */
        $usedPoints = CharacterSpellPoints::find()->where(['character_id' => $character_id, 'spell_level' => $level])->one();
        if (!empty($usedPoints))
            return $usedPoints->spell_point;
        return 0;
    }

    public function actionUse_spell()
    {
        $character_id = Yii::$app->request->get('id', null);
        $level = Yii::$app->request->get('level', Yii::$app->request->post('level', null));
        $points = $this->getSpellMaxPoints($character_id);
        if (!isset($points[$level]))
            $points[$level] = 0;
        $alreadyUsed = $this->getUsedSpellPoint($character_id, $level);

        if ($alreadyUsed >= $points[$level])
            return json_encode(['code' => 400, 'text' => 'Недостаточно ячеек', 'used' => $alreadyUsed]);

        /** @var CharacterSpellPoints $usedSpellPoint */
        $usedSpellPoint = CharacterSpellPoints::find()->where(['character_id' => $character_id, 'spell_level' => $level])->one();
        if (is_object($usedSpellPoint)) {
            $usedSpellPoint->spell_point = $usedSpellPoint->spell_point + 1;
        } else {
            $usedSpellPoint = new CharacterSpellPoints();
            $usedSpellPoint->spell_level = $level;
            $usedSpellPoint->character_id = $character_id;
            $usedSpellPoint->spell_point = 1;
        }
        if ($usedSpellPoint->save())
            return json_encode(['code' => 200, 'text' => 'OK', 'used' => $usedSpellPoint->spell_point, 'exist' => ($points[$level] - $alreadyUsed - 1)]);
        return json_encode(['code' => 400, 'text' => var_export($usedSpellPoint->getErrors(), TRUE), 'used' => $alreadyUsed]);
    }

    public function actionUse_talent()
    {
        $character_id = Yii::$app->request->get('id', null);
        $talent_id = Yii::$app->request->get('talent_id', null);

        /** @var Character $character */
        $character = Character::find()->where(['id' => $character_id])->one();
        if (!is_object($character))
            return json_encode(['code' => 404, 'text' => 'Have no character']);


        $character_talent = CharacterTalent::find()->where(['character_id' => $character_id, 'talent_id' => $talent_id])->one();
        if (!is_object($character_talent))
            return json_encode(['code' => 404, 'text' => 'Have no talent']);

        if ($character_talent->used + 1 > $character_talent->talent->count)
            return json_encode(['code' => 400, 'text' => 'Have no talent use']);

        $character_talent->used = $character_talent->used + 1;
        if ($character_talent->save())
            return json_encode(['code' => 200, 'text' => 'OK', 'used' => $character_talent->used]);
        else
            return json_encode(['code' => 400, 'text' => var_export($character_talent->getErrors(), TRUE)]);


    }

    public function action_use_talent()
    {
        $character_id = Yii::$app->request->get('id', null);
        $talent_id = Yii::$app->request->get('talent_id', null);
        $to_use = Yii::$app->request->get('to_use', 1);
        /** @var Character $character */
        $character = Character::find()->where(['id' => $character_id])->one();
        if (!is_object($character))
            return json_encode(['status' => ['code' => 404, 'text' => 'Have no character'], 'data' => []]);
        /** @var CharacterTalent $character_talent */
        $character_talent = CharacterTalent::find()->where(['character_id' => $character_id, 'talent_id' => $talent_id])->one();
        if (is_object($character_talent)) {
            if ($character_talent->used + $to_use > $character_talent->talent->count) {
                return json_encode(['status' => ['code' => 400, 'text' => 'Not enough talent for use'], 'data' => []]);
            } else {
                $character_talent->usedObj->used = $character_talent->usedObj->used + $to_use;
                if ($character_talent->usedObj->save()) {
                    $left = $character_talent->talent->count - $character_talent->used;
                    return json_encode(['status' => ['code' => 200, 'text' => 'OK'], 'data' => ['left' => $left]]);
                } else {
                    return json_encode(['status' => ['code' => 400, 'text' => var_export($character_talent->usedObj->getErrors(), TRUE)]]);
                }
            }
        } elseif (!is_object($character_talent)) {
            $classTalent = $character->getClassTalent($talent_id);
            if (!is_object($classTalent)) {
                return json_encode(['status' => ['code' => 404, 'text' => 'Have no talent'], 'data' => []]);
            } else {
                $usedObj = CharacterTalentUsed::find()->where(['character_id' => $character->id, 'talent_id' => $talent_id])->one();
                if (!is_object($usedObj)) {
                    $usedObj = new CharacterTalentUsed();
                    $usedObj->character_id = $character->id;
                    $usedObj->talent_id = $talent_id;
                    $usedObj->used = 0;
                }
                if ($usedObj->used + $to_use > $classTalent->talent->count) {
                    return json_encode(['status' => ['code' => 400, 'text' => 'Not enough talent for use'], 'data' => []]);
                } else {
                    $usedObj->used = $usedObj->used + $to_use;
                    if ($usedObj->save()) {
                        $left = $classTalent->talent->count - $usedObj->used;
                        return json_encode(['status' => ['code' => 200, 'text' => 'OK'], 'data' => ['left' => $left]]);
                    } else {
                        return json_encode(['status' => ['code' => 400, 'text' => var_export($usedObj->getErrors(), TRUE)]]);
                    }
                }
            }
        }
        return json_encode(['status' => ['code' => 400, 'text' => 'Something going wrong']]);
    }

    public function actionViewParty()
    {
        $name = Yii::$app->request->get('id', null);
        $party = CharacterParty::find()->where(['party_identifier' => $name])->all();
        return $this->render('party', [
            'party' => $party,
            'name'=>$name
        ]);
    }

    public function actionRest_talent()
    {
        $character_id = Yii::$app->request->get('id', null);
        $talent_id = Yii::$app->request->get('talent_id', null);

        $character_talent = CharacterTalent::find()->where(['character_id' => $character_id, 'talent_id' => $talent_id])->one();
        if (!is_object($character_talent))
            return json_encode(['code' => 404, 'text' => 'Have no talent']);


        $character_talent->used = 0;
        if ($character_talent->save())
            return json_encode(['code' => 200, 'text' => 'OK', 'used' => $character_talent->used]);
        else
            return json_encode(['code' => 400, 'text' => var_export($character_talent->getErrors(), TRUE)]);


    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Character models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CharacterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a items Character model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionItems($id)
    {
        return $this->render('items', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Displays a single Character model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionOldview($id)
    {
        return $this->render('view', ['model' => $this->findModel($id),]);
    }

    /**
     * Displays a single Character model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        //return $this->render('view', ['model' => $this->findModel($id),]);
        return $this->render('view_new2', ['model' => $this->findModel($id),]);
    }

    /**
     * Displays a single Character model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView2($id)
    {
        return $this->render('view_new2', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Character model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Character();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Character model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Character model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Character model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Character the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Character::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
