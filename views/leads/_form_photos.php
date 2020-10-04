<?php

use app\models\LeadImages;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LeadDesign */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="lead-design-form">

        <ul class="nav nav-tabs">
            <li><a href="<?= Url::to(['update', 'id' => $leadModel->pkLeadID]); ?>">Details</a></li>
            <li><a href="<?= Url::to(['measurements', 'id' => $leadModel->pkLeadID]); ?>">Measurement</a></li>
            <li><a href="<?= Url::to(['design', 'id' => $leadModel->pkLeadID]); ?>">Design</a></li>
            <li><a href="#">Estimate</a></li>
            <li><a href="<?= Url::to(['delivery', 'id' => $leadModel->pkLeadID]); ?>">Delivery</a></li>
            <li class="active"><a href="<?= Url::to(['photos', 'id' => $leadModel->pkLeadID]); ?>">Photos</a></li>
            <li><a href="<?= Url::to(['notes', 'id' => $leadModel->pkLeadID]); ?>">Notes</a></li>
            <li><a href="<?= Url::to(['reminder', 'id' => $leadModel->pkLeadID]); ?>">Reminder</a></li>
        </ul>

        <div class="box-default estimate-box">
            <div class="box-body">
                <div class="col-md-12">
                    <h3>Estimate: <?= $leadModel->pkLeadID; ?></h3>
                    <div class="pull-right">
                        <a href="javascript:void(0)" class="btn btn-primary btn-xs">View Estimate</a>
                        <a href="javascript:void(0)" class="btn btn-success btn-xs">Mark Won</a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-xs">Mark Lost</a>
                    </div>
                </div>
                <div class="clearfix">
                    <div class="col-md-3">
                        Opportunity for <?= $leadModel->fkContact->contactPersons[0]->contactPersonFullName; ?>
                    </div>
                    <div class="col-md-3">
                        <i class="fa fa-envelope" aria-hidden="true"></i>
                        <?= $leadModel->fkContact->contactPersons[0]->contactPersonEmail; ?>
                    </div>
                </div>

                <div class="clearfix">
                    <div class="col-md-3">
                        <?= $leadModel->fkContact->contactAddress; ?>,<br/>
                        <?= $leadModel->fkContact->contactAddress2; ?>,<br/>
                        <?= $leadModel->fkContact->contactCity; ?> <?= $leadModel->fkContact->contactState; ?> <?= $leadModel->fkContact->contactCountry; ?> <?= $leadModel->fkContact->contactZip; ?>
                        <br/>
                    </div>
                    <div class="col-md-3">
                        <i class="fa fa-phone" aria-hidden="true"></i>
                        <?= $leadModel->fkContact->contactPersons[0]->contactPersonPhone; ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="box box-default">
            <div class="box-body">
                <h4><?= (!$leadImages) ? 'Photos': 'Details'; ?></h4>

                <div class="row">
                    <?php $form = ActiveForm::begin(['action' => ['leads/upload-photos', 'id' => $leadModel->pkLeadID]]); ?>
                    <?php $model->fkLeadID = $leadModel->pkLeadID; ?>

                    <div class="col-md-3">
                        <?= $form->field($model, 'fkLeadID')->hiddenInput()->label(false); ?>
                        <?= $form->field($model, 'leadImageNameFiles[]')->fileInput(['multiple' => true])->label(false) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($model, 'leadImageType')->dropDownList([
                                'BeforePhotos' => 'Before Photos',
                                'Sketch' => 'Sketch',
                                '2D3D' => '2D & 3D'
                        ])->label(false); ?>
                    </div>
                    <div class="col-md-3">
                            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
                    </div>


                    <?php ActiveForm::end(); ?>
                </div>

                <div class="row">
                    <?php
                    if (!empty(Yii::$app->request->get('type'))) {
                        if (count($leadImages) > 0) {
                            foreach ($leadImages as $eachImage) :
                                ?>
                                <div class="col-lg-3 col-md-4 col-xs-6 thumb">

                                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="<?= $eachImage->leadImageName; ?>"
                                       data-image="<?= Url::base() . Yii::$app->params['leadImagePath'] . $eachImage->leadImageName; ?>"
                                       data-target="#image-gallery">
                                        <?php echo Html::img(Url::base() . Yii::$app->params['leadImagePath'] . $eachImage->leadImageName, ['class' => 'img-thumbnail lead-photos-thumbnail']); ?>
                                        <span><?= $eachImage->leadImageName; ?></span>
                                    </a>
                                </div>
                            <?php endforeach; ?>

                            <?php
                        } else {
                            ?>
                            <p>No Photos available.</p>
                            <?php
                        }
                    } else {
                        ?>
                        <table class="table table-striped table-bordered">
                            <?php
                            $leadImagesColumns = [
                                    'BeforePhotos' => 'Before Photos',
                                    'Sketch' => 'Sketch',
                                    '2D3D' => '2D & 3D'
                            ];
                            foreach($leadImagesColumns as $eachColumnKey => $eachColumnValue) {
                                ?>
                                <tr>
                                    <td style="width:120px;">
                                        <a href="<?= Url::to(['/leads/photos', 'id' => $leadModel->pkLeadID, 'type' => $eachColumnKey]); ?>" title="<?= $eachColumnValue; ?>">
                                            <?php
                                            $leadImage = LeadImages::find()
                                                ->select('leadImageName')
                                                ->where([
                                                    'leadImageType' => $eachColumnKey,
                                                    'fkLeadID' => $leadModel->pkLeadID
                                                ])->one();

                                            if($leadImage) {
                                                echo  Html::img(Url::base() . Yii::$app->params['leadImagePath'] .$leadImage->leadImageName , ['class' => 'img-thumbnail', 'style' => 'width: 100px; height: 100px;']);
                                            } else {
                                                echo  Html::img(Url::base() .'/images/no-image.png' , ['class' => 'img-thumbnail', 'style' => 'width: 100px; height: 100px;']);
                                            }
                                            ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?= Html::a($eachColumnValue, ['/leads/photos', 'id' => $leadModel->pkLeadID, 'type' => $eachColumnKey]) ?>
                                    </td>
                                    <td>
                                        <?= LeadImages::find()
                                            ->where(['leadImageType' => $eachColumnKey])
                                            ->andWhere(['fkLeadID' => $leadModel->pkLeadID])
                                            ->count();
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="image-gallery-title"></h4>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span
                                class="sr-only">Close</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i
                                class="fa fa-arrow-left"></i>
                    </button>

                    <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i
                                class="fa fa-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>


<?php
$js = <<<EOD
let modalId = $('#image-gallery');

$(document)
  .ready(function () {

    loadGallery(true, 'a.thumbnail');

    //This function disables buttons when needed
    function disableButtons(counter_max, counter_current) {
      $('#show-previous-image, #show-next-image')
        .show();
      if (counter_max === counter_current) {
        $('#show-next-image')
          .hide();
      } else if (counter_current === 1) {
        $('#show-previous-image')
          .hide();
      }
    }

    /**
     *
     * @param setIDs        Sets IDs when DOM is loaded. If using a PHP counter, set to false.
     * @param setClickAttr  Sets the attribute for the click handler.
     */

    function loadGallery(setIDs, setClickAttr) {
      let current_image,
        selector,
        counter = 0;

      $('#show-next-image, #show-previous-image')
        .click(function () {
          if ($(this)
            .attr('id') === 'show-previous-image') {
            current_image--;
          } else {
            current_image++;
          }

          selector = $('[data-image-id="' + current_image + '"]');
          updateGallery(selector);
        });

      function updateGallery(selector) {
        let \$sel = selector;
        current_image = \$sel.data('image-id');
        $('#image-gallery-title')
          .text(\$sel.data('title'));
        $('#image-gallery-image')
          .attr('src', \$sel.data('image'));
        disableButtons(counter, \$sel.data('image-id'));
      }

      if (setIDs == true) {
        $('[data-image-id]')
          .each(function () {
            counter++;
            $(this)
              .attr('data-image-id', counter);
          });
      }
      $(setClickAttr)
        .on('click', function () {
          updateGallery($(this));
        });
    }
  });

// build key actions
$(document)
  .keydown(function (e) {
    switch (e.which) {
      case 37: // left
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-previous-image').is(":visible")) {
          $('#show-previous-image')
            .click();
        }
        break;

      case 39: // right
        if ((modalId.data('bs.modal') || {})._isShown && $('#show-next-image').is(":visible")) {
          $('#show-next-image')
            .click();
        }
        break;

      default:
        return; // exit this handler for other keys
    }
    e.preventDefault(); // prevent the default action (scroll / move caret)
  });

EOD;

$this->registerJs(
    $js,
    View::POS_READY
);
?>