<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

/**
 * CmiProductSurveys Controller
 *
 * @property \App\Model\Table\CmiProductSurveysTable $CmiProductSurveys
 */
class CmiProductSurveysController extends AppController
{
    public function ajaxAddSurvey()
    {
        $surveysTable = TableRegistry::get('CmiProductSurveys');
        $survey = $surveysTable->newEntity();
        $survey->cmi_product_id = $this->request->data['cmi_product_id'];
        $survey->cmi_full_url = $this->request->data['cmi_full_url'];
        $survey->answer1 = $this->request->data['answer1'];
        $survey->answer2 = $this->request->data['answer2'];
        $survey->answer3 = $this->request->data['answer3'];
        $survey->data1 = $this->request->data['data1'];
        $survey->data2 = $this->request->data['data2'];

        $sample_response = [];
        if ($surveysTable->save($survey)) {
            // The $article entity contains the id now
            array_push($sample_response, ['response'=>'success']);
        }else{
            array_push($sample_response, ['response'=>'fail']);
        }

        $this->set('dataRet', $sample_response);
        $this->set('_serialize', ['dataRet']);
        $this->render('/Element/ajax_view', 'ajax');
    }

}
