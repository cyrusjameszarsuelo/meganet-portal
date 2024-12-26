<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Behavior;
use App\Models\Nominee;
use App\Models\NomineeBehavior;
use App\Models\NomineeValue;
use App\Models\OurValue;
use App\Models\SiglaDepartment;
use App\Models\SiglaNominee;
use Illuminate\Http\Request;
use Dcblogdev\MsGraph\Facades\MsGraph;
use Response;

class NominationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = MsGraph::get('me');
        $listOfUser = self::getValidEmployees();
        $corporateOffice = $this->getCorporateOffice();
        $runningCredit = $this->getRunningCredit();
        $values = OurValue::all();
        $siglaNominees = SiglaNominee::where('email', '!=', $user['mail'])
            ->orderBy('name')
            ->get();
        $siglaDepartments = SiglaDepartment::all();

        return view('pages.nomination')
            ->withUser($user)
            ->withListOfUser($listOfUser)
            ->withRunningCredit($runningCredit)
            ->withCorporateOffice($corporateOffice)
            ->withSiglaNominees($siglaNominees)
            ->withSiglaDepartments($siglaDepartments)
            ->withValues($values);
    }

    public function mechanics()
    {
        $runningCredit = $this->getRunningCredit();
        $user = MsGraph::get('me');
        $corporateOffice = $this->getCorporateOffice();

        return view('pages.nominationMechanics')
            ->withCorporateOffice($corporateOffice)
            ->withUser($user)
            ->withRunningCredit($runningCredit);

    }

    public function group()
    {
        $user = MsGraph::get('me');
        $corporateOffice = $this->getCorporateOffice();
        $runningCredit = $this->getRunningCredit();
        $values = OurValue::all();
        $siglaNominees = SiglaNominee::where('email', '!=', $user['mail'])
            ->orderBy('name')
            ->get();
        $siglaDepartments = SiglaDepartment::all();

        return view('pages.nomination-group')
            ->withUser($user)
            ->withRunningCredit($runningCredit)
            ->withCorporateOffice($corporateOffice)
            ->withSiglaNominees($siglaNominees)
            ->withSiglaDepartments($siglaDepartments)
            ->withValues($values);
    }

    public function getBehavior(Request $request)
    {
        $behaviors = Behavior::whereIn('our_value_id', $request->data)->get();
        return $behaviors;
        // return $request->data;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->nominee_type == 'individual') {
            $findNominee = Nominee::where('name', $request->nominee)
                ->where('user_nominate', $request->user_nominate)
                ->first();
        } else {
            $findNominee = Nominee::whereNull('name')
                ->where('department', $request->department)
                ->where('user_nominate', $request->user_nominate)
                ->first();
        }

        $valueDuplicates = array();
        $behaviorDuplicates = array();
        $valueCounter = 0;
        $behaviorCounter = 0;


        if ($findNominee) {

            foreach ($request->valuesMultiple as $key => $value) {
                $findNomineeValue = NomineeValue::where('nominee_id', $findNominee->id)
                    ->where('our_value_id', $value)
                    ->where('user_nominate', $request->user_nominate)
                    ->get();

                if (count($findNomineeValue) == 0) {
                    self::storeValue($value, $request, $findNominee);
                    $valueCounter += 1;
                } else {
                    $getValue = OurValue::find($value);
                    array_push($valueDuplicates, $getValue->value);
                }
            }

            foreach ($request->behavior as $behavior) {
                $findNomineeBehavior = NomineeBehavior::where('nominee_id', $findNominee->id)
                    ->where('behavior_id', $behavior)
                    ->where('user_nominate', $request->user_nominate)
                    ->get();


                if (count($findNomineeBehavior) == 0) {
                    self::storeBehavior($behavior, $request, $findNominee);
                    $behaviorCounter += 1;
                } else {
                    $getBehavior = Behavior::find($behavior);

                    array_push($behaviorDuplicates, $getBehavior->behavior);
                }

            }

            if ($valueCounter == 0 && $behaviorCounter == 0) {
                return false;
            } else if ($valueDuplicates || $behaviorDuplicates) {
                return Response::json([$valueDuplicates, $behaviorDuplicates]);
            } else {
                return true;
            }

        } else {
            $nomination = self::storeNominee($request);


            foreach ($request->behavior as $behavior) {
                self::storeBehavior($behavior, $request, $nomination);

            }


            foreach ($request->valuesMultiple as $value) {
                self::storeValue($value, $request, $nomination);
            }

            return Response::json($nomination);

        }

    }

    public function storeNominee($data)
    {
        $nomination = new Nominee;

        $nomination->name = $data->nominee;
        $nomination->department = $data->department;
        $nomination->critical_incidents = $data->critical_incidents;
        $nomination->result_impact = $data->result_impact;
        $nomination->user_nominate = $data->user_nominate;

        $nomination->save();

        return $nomination;

    }

    public function storeBehavior($behavior, $data, $nomination)
    {
        $nomination_behaviors = new NomineeBehavior;

        $nomination_behaviors->nominee_id = $nomination->id;
        $nomination_behaviors->behavior_id = $behavior;
        $nomination_behaviors->user_nominate = $data->user_nominate;

        $nomination_behaviors->save();
    }

    public function storeValue($value, $data, $nomination)
    {
        $nomination_values = new NomineeValue;

        $nomination_values->nominee_id = $nomination->id;
        $nomination_values->our_value_id = $value;
        $nomination_values->user_nominate = $data->user_nominate;

        $nomination_values->save();
    }

    public function getValidEmployees()
    {
        // $email_address = [
        //     ["name" => 'JIMENEZ, NIÑO JOVIT', "email" => 'njjimenez@megawide.com.ph'],
        //     ["name" => 'DE GUZMAN, REZA MARIE', "email" => 'rdeguzman@megawide.com.ph'],
        //     ["name" => 'INAO, KRISTINE AIRA', "email" => 'kainao@megawide.com.ph'],
        //     ["name" => 'SAYON, JOSE ENRIQUE', "email" => 'jesayon@megawide.com.ph'],
        //     ["name" => 'SALILICAN, MELISSA', "email" => 'msalilican@megawide.com.ph'],
        //     ["name" => 'MATIAS, WINNIE', "email" => 'wmatias@megawide.com.ph'],
        //     ["name" => 'EVANGELISTA, NIGEL BRYANT', "email" => 'nbevangelista@megawide.com.ph'],
        //     ["name" => 'PASCUA, JUSTIN JUNEL', "email" => 'jjpascua@megawide.com.ph'],
        //     ["name" => 'INCIONG, KRISTINA MAE', "email" => 'kinciong@megawide.com.ph'],
        //     ["name" => 'OCAMPO, LADY FATIMA', "email" => 'lfocampo@megawide.com.ph'],
        //     ["name" => 'SALEAH JOY UCLUSIN', "email" => 'sjuclusin@megawide.com.ph'],
        //     ["name" => 'MACANAYA, ELIZABETH ANN', "email" => 'eamacanaya@megawide.com.ph'],
        //     ["name" => 'CONTRERAS, RHIZ KATHLEEN', "email" => 'rkcontreras@megawide.com.ph'],
        //     ["name" => 'BARTE, JAYSON', "email" => 'jbarte@megawide.com.ph'],
        //     ["name" => 'GARCIA, JOHN PATRICK', "email" => 'jpgarcia@megawide.com.ph'],
        //     ["name" => 'JASMIN FERNANDEZ', "email" => 'jfernandez@megawide.com.ph'],
        //     ["name" => 'FERNANDO MIGUEL Z. LOZANO', "email" => 'fmlozano@megawide.com.ph'],
        //     ["name" => 'GYAN LOUIE C. GLORIANI', "email" => 'ggloriani@megawide.com.ph'],
        //     ["name" => 'AZOGUE, NIERRA JOBEL', "email" => 'njazogue@megawide.com.ph'],
        //     ["name" => 'JARAMILLO, JAMES MATTHEW', "email" => 'jmjaramillo@megawide.com.ph'],
        //     ["name" => 'UMALI, DONELLE CHARMAGNE', "email" => 'dcumali@megawide.com.ph'],
        //     ["name" => 'OSMA, TIMOTHY', "email" => 'tosma@megawide.com.ph'],
        //     ["name" => 'BAUTISTA, JOHN PAUL', "email" => 'jpbautista@megawide.com.ph'],
        //     ["name" => 'GLOVA, TIMOTHY ALEXANDER', "email" => 'taglova@megawide.com.ph'],
        //     ["name" => 'FERRER, EMILIO', "email" => 'jeferrer@megawide.com.ph'],
        //     ["name" => 'PAJARO, MARIA IMMACULADA', "email" => 'mipajaro@megawide.com.ph'],
        //     ["name" => 'SAMBAJON, GRACE MARRIE', "email" => 'gmsambajon@megawide.com.ph'],
        //     ["name" => 'DELA PEÑA, ABEGAIL', "email" => 'adelapena@megawide.com.ph'],
        //     ["name" => 'SUAVERDEZ, JOHN KENNETH', "email" => 'jksuaverdez@megawide.com.ph'],
        //     ["name" => 'SANTANA, ALDEN', "email" => 'asantana@megawide.com.ph'],
        //     ["name" => 'SABERON, JAMIE ANN', "email" => 'jasaberon@megawide.com.ph'],
        //     ["name" => 'ENRIQUEZ, FRANSCOISE "FRANS"', "email" => 'fenriquez@megawide.com.ph'],
        //     ["name" => 'TRINIDAD, CHARMAINE "MENG"', "email" => 'ctrinidad@megawide.com.ph'],
        //     ["name" => 'DE GUZMAN, JAN CARLO', "email" => 'jcdeguzman@megawide.com.ph'],
        //     ["name" => 'SIBULAN, BON NELSON', "email" => 'bnsibulan@megawide.com.ph'],
        //     ["name" => 'SANTOS, JELLICA AINE', "email" => 'jasantos2@megawide.com.ph'],
        //     ["name" => 'MANUEL, CLAUDINE', "email" => 'cmanuel1@megawide.com.ph'],
        //     ["name" => 'MAGO, LEO PACHOLO "LEI"', "email" => 'lmago@megawide.com.ph'],
        //     ["name" => 'CAPAYCAPAY, AERIELLE MAE', "email" => 'amcapaycapay@megawide.com.ph'],
        //     ["name" => 'CARLOS, CHRISTOPHER JOSE', "email" => 'cjcarlos@megawide.com.ph'],
        //     ["name" => 'BUENAFLOR, JOMAR', "email" => 'jbuenaflor@megawide.com.ph'],
        //     ["name" => 'ANCHETA, JOANA ANGELICA', "email" => 'jaancheta@megawide.com.ph'],
        //     ["name" => 'AGCAOILI, ROANILI MONNETH', "email" => 'rmagcaoili@megawide.com.ph'],
        //     ["name" => 'CABATU, RICKY BOY', "email" => 'rbcabatu@megawide.com.ph'],
        //     ["name" => 'GASAPO, NICA MARSHA', "email" => 'nmgasapo@megawide.com.ph'],
        //     ["name" => 'PASAMBA, RICCI ANGELO', "email" => 'rpasamba@megawide.com.ph'],
        //     ["name" => 'BORBON, IVANA JANE', "email" => 'iborbon@megawide.com.ph'],
        //     ["name" => 'NONES, JOSELITO "JAGE"', "email" => 'jnones@megawide.com.ph'],
        //     ["name" => 'LAGROSA, KRISTINE JOYCE', "email" => 'kjlagrosa@megawide.com.ph'],
        //     ["name" => 'NOCUM, JOHN REANER', "email" => 'rnocum@megawide.com.ph'],
        //     ["name" => 'YOUNG, MILESTILL', "email" => 'myoung@megawide.com.ph'],
        //     ["name" => 'MANALASTAS, LEAH', "email" => 'lmanalastas@megawide.com.ph'],
        //     ["name" => 'SANGELES, BENNIE', "email" => 'bsangeles@megawide.com.ph'],
        //     ["name" => 'SILVESTRE, JOVIE MILAGROS', "email" => 'jmsilvestre@megawide.com.ph'],
        //     ["name" => 'CHUA, STEPHANIE', "email" => 'schua@megawide.com.ph'],
        //     ["name" => 'AUSTRIA, FRENIEL MIKKO', "email" => 'fmaustria@megawide.com.ph'],
        //     ["name" => 'FRESNOZA, KATHERINE', "email" => 'kfresnoza@megawide.com.ph'],
        //     ["name" => 'STEPHANIE SOON', "email" => 'ssoon@megawide.com.ph'],
        //     ["name" => 'ERIC RIAN LOMIBAO', "email" => 'erlomibao@megawide.com.ph'],
        //     ["name" => 'CHAVEZ, JESIREE', "email" => 'jchavez@megawide.com.ph'],
        //     ["name" => 'DELA CRUZ, JANELLE CARYN', "email" => 'jcdelacruz@megawide.com.ph'],
        //     ["name" => 'ADA, NEIL KIRBY', "email" => 'nkada@megawide.com.ph'],
        //     ["name" => 'ESGUERRA, PRYNCESS HYACINTH', "email" => 'phesguerra@megawide.com.ph'],
        //     ["name" => 'GO, GIANCHARLIE', "email" => 'ggo@megawide.com.ph'],
        //     ["name" => 'CASTRO, CARMELA', "email" => 'ccastro@megawide.com.ph'],
        //     ["name" => 'BONDOY, ROLANDO S. ', "email" => 'rbondoy@megawide.com.ph'],
        //     ["name" => 'DELA CRUZ, JEZ G. ', "email" => 'jgdelacruz@megawide.com.ph'],
        //     ["name" => 'FELICIANO, JAIME RAPHAEL C. ', "email" => 'jfeliciano@megawide.com.ph'],
        //     ["name" => 'FERRER, MANUEL LOUIE B. ', "email" => 'louie@megawide.com.ph'],
        //     ["name" => 'GOMEZ, RAYMUND JAY S. ', "email" => 'rgomez@megawide.com.ph'],
        //     ["name" => 'MORALES, MARIA BELINDA B. ', "email" => 'bmorales@megawide.com.ph'],
        //     ["name" => 'NADAYAG, CHRISTOPHER A. ', "email" => 'cnadayag@megawide.com.ph'],
        //     ["name" => 'SAAVEDRA, EDGAR B. ', "email" => 'esaavedra@megawide.com.ph'],
        //     ["name" => 'TOPACIO, ANTHONY LEONARD G. ', "email" => 'atopacio@megawide.com.ph'],
        //     ["name" => 'ZARSUELO, CYRUS JAMES L. ', "email" => 'cjzarsuelo@megawide.com.ph'],
        // ];

        // return $email_address;

        $siglaNominee = SiglaNominee::all();

        return Response::json($siglaNominee);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
