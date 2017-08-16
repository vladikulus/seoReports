<?php

namespace App\Http\Controllers;

require base_path('vendor/autoload.php');



use App\Http\Requests\AutoTextRequest;
use App\Http\Requests\ReportFormRequest;
use App\Project;
use App\Report;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{

    function index(){

        $data = [];
        $projects = Project::all();

        $data['projects'] = $projects;

        return view('reports.create', $data);
    }

    function setup($id){
        $project = Project::find($id);
        return view('reports.setup')->with('project', $project);
    }

    function download(ReportFormRequest $request){

        $report = new Report\Report();
        $unicId = $report->create($request);

        $file = (app_path('Stats/' . $unicId . '.docx'));

        header('Content-Description: File Transfer');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));

        readfile($file);

        unlink($file);

        exit();
    }

    function upload(ReportFormRequest $request){

        $report = new Report\Report();
        $unicId = $report->create($request);

        $filesystem = new Filesystem();
        $content = $filesystem->get(app_path('Stats/' . $unicId . '.docx'));

        Storage::disk('dropbox')->put('report.docx', $content);

        $file = (app_path('Stats/' . $unicId . '.docx'));
        unlink($file);
        return true;
    }



    function getAutoText(AutoTextRequest $request){

        $period = !empty($request->get('period')) ? $request->get('period') : $request->get('dop_work');

        switch($period){
            case 1:
                return view('reports.autotext.month1')->render();
                break;
            case 2:
                return view('reports.autotext.month2')->render();
                break;
            case 7:
                return view('reports.autotext.month7')->render();
                break;
            default:
                return '';
        }
    }

    function generatePreview(Request $request){

        /*$today = Carbon::parse($request->input('date'));

        $siteKey = $request->input('siteid');
        $rinkingKey = $request->input('se_ranking');


        $MetrikData = new MetricStats($siteKey, $rinkingKey, $today);

        $statsData = [];

        //Общая посещаемость сайта--------------------------------------------------------------------------------------------------------------------------------------------------------------
        $statsData['totalVisitsData'] = $MetrikData->getTotalVisitsData();

        //поисковые системы----------------------------------------------------------------------------------------------------------------------------------------------------------------------------
        //$statsData['totalSEData'] = $MetrikData->getSEData($today);

        //Глубина просмотров
        $resultData = $MetrikData->getDepthData();
        if(!isset($resultData)) {return;}

        $statsData['depthData'] = ['totals' => $resultData];

        //Время на сайте
        $resultData = $MetrikData->getTimeData();

        $timeRows = [];
        foreach($resultData["data"] as $key => $data) {
            $data[2] = round($data[2] / $data["count"], 2);

            $data[3] = gmdate('H:i:s', ceil(($data[3] / $data["count"]) % 86400));

            $data["key"] = $key;
            $timeRows[] = $data;
        }

        $statsData['timeData'] = ['totals' => $resultData["totals"], "rows" => $timeRows];

        return view('reports.html.index', $statsData);*/
        return view('reports.html.index');
    }
}
