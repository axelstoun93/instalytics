<?php
namespace App\Http\Controllers\Client;

use App\ClientMenu;
use App\Repositories\Assistant\DataAssistant;
use App\Repositories\ClientMenuRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PayController extends ClientController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        parent::__construct(new ClientMenuRepository(new ClientMenu));
        $this->template = 'pay';
    }

    public function index(Request $request)
    {

        $client = $this->u_rep->clientInfo(Auth::id());
        $nowDate = DataAssistant::nowDay();
        $dateRus = DataAssistant::DayAndMountFormatFull($nowDate);

        $payStatus = (!empty($request->statusPay) and $request->statusPay === 'success') ? true : false;

        $defaultSum = $this->calculationAmount();

        $content = view(config('setting.theme-client') . '.payContent')->with(['client' => $client, 'date' => $dateRus, 'payStatus' => $payStatus, 'defaultSum' => $defaultSum])->render();
        $this->vars = array_add($this->vars, 'content', $content);
        return $this->renderOutput();

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function calculationAmount()
    {
        $defaultSum = 500;
        $commissionAC = 0.02;
        $readySum = '';
        $readySum = ceil($defaultSum + $defaultSum * ($commissionAC / (1 + $commissionAC)));
        return $readySum;
    }
}
