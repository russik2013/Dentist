<?php namespace Modules\Posts\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
//use Maatwebsite\Excel\Excel;
//use Maatwebsite\Excel;
use Maatwebsite\Excel\Facades\Excel;
use PHPExcel_IOFactory;
use Yangqi\Htmldom\Htmldom;
use Pingpong\Modules\Routing\Controller;

use App\XLS as Repo;
use App\Piliron;
//use PHPExcel;
//use Maatwebsite\Excel\Classes\PHPExcel as Repo;

class PostsController extends Controller {
	
	public function index()
	{
		return view('posts::index');
	}

    public function parseXLS()
    {
        return view('posts::xlsParse');
    }


    public function parse(Request $request)
    {

        if(isset($request['url']) && !empty($request['url'])) {

            $html = new Htmldom($request['url']);
            $parse = '';
            $hrefs = '';
            $cols ='';
            switch ($request['type']) {
                case 'a':
                    $i = 0;

                    foreach ($html->find('table td') as $element) {
                        if($parse == '')
                            $parse .= '<td><a href="/posts/parse/finance/'.$element->plaintext.'">'.$element->plaintext.'</td>';
                        else
                            $parse .= '<td>'.$element->plaintext.'</td>';
                        $i++;
                        if($i%6 ==0){
                            $cols .= '<tr>'.$parse.'</tr>';
                            $parse='';
                        }
                    }


                    $table = "<table>".$cols."</table>";


                    break;
                case 'img':
                    $hrefs = '1';
                    foreach ($html->find($request['type']) as $element) {

                        $parse .= $element->src . '<br/>';

                    }
                    break;
                default:
                    $hrefs = '2';
                    $parse = "Неизвестный тип запроса";
            }

        }else{
            $parse = 'Введите ссылку';
            $hrefs = '3';
        }

        //dd($hrefs);
        return ['mass' => $table];
    }

    public function parseFinance($id)
    {
        $html = new Htmldom('http://www.reuters.com/finance/markets/index?symbol='.$id);
        $parse = '';
        foreach ($html->find('div[id=headerQuoteContainer], table.indexInfo') as $element) {

                $parse .= $element->plaintext.'<br/><br/><br/><br/>';

        }
        foreach ($html->find('img') as $element) {

            $images []= $element->src . '<br/>';

        }
        $normId = explode(' ', $id);

        $img = file_get_contents($images[0]);
        file_put_contents('parse/img'.$normId[5].'.png', $img);

        $item = Piliron::where('name', $normId[5]) -> get();

        $imgUrl = $item[0]->url;



        return view('posts::FinanceParse',compact('parse','images','imgUrl'));
    }

    public function doParseXLS(Request $request){


        //$inputFileType = PHPExcel_IOFactory::identify($filepath);  // узнаем тип файла, excel может хранить файлы в разных форматах, xls, xlsx и другие
      //  $objReader = PHPExcel_IOFactory::createReader($inputFileType); // создаем объект для чтения файла
       // $objPHPExcel = $objReader->load($filepath); // загружаем данные файла в объект
      //  $ar = $objPHPExcel->getActiveSheet()->toArray(); // выгружаем данные из объекта в массив

        $Excel= Excel::load('Carculator.xls', function($reader) {
        })->get();



        $i = 0;
        $j = 0;
        foreach ($Excel[2] as $item){
            if($j > 4) {

                $insert[$i]['numm_title'] = $item->opisanie_kodov_tnved;
                $insert[$i]['numm_id'] =  $item->kod;
                $i++;
            }
            $j++;
        }



        for($i = 0; $i < count($insert); $i++){
            $post = new Repo();
            $post->fill($insert[$i]);

            $post->save();

        }



        $i = 0;
        $j = 0;
        foreach ($Excel[0] as $item){
            if($j > 4) {

                $insertMass[$i]['numm_title'] = $item->obemnyy_ves_avia_ne_menee_167_kg_v_kube;
                $insertMass[$i]['air_express'] = $item->avia_ekspress;
                $insertMass[$i]['air'] = $item->avia_standart;
                $insertMass[$i]['customs_air'] = $item->avia_tomozhnya;
                $insertMass[$i]['train'] = $item->train;
                $insertMass[$i]['sea'] = $item->sea;
                $insertMass[$i]['customs_train'] = $item->tamozhnya;
                $insertMass[$i]['customs_sea'] = $item->tamozhnya;
                $insertMass[$i]['numm_id'] = $item->id_tovar;
                $insertMass[$i]['updated_at'] = Carbon::now();
                $insertMass[$i]['created_at'] = Carbon::now();

                $i++;
            }
           $j++;
        }
        for($i = 0; $i < count($insertMass); $i++){
            $post = new Repo();
            $post->fill($insertMass[$i]);

            $post->save();

        }


        dd($insertMass);
    }


}