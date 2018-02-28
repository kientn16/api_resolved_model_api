<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class ApiController extends Controller
{
    protected $model;
    protected $response;
    protected $request;

    protected $orderByField = 'display_order';

    public function __construct(
        Request $request,
        ApiResponse $response
    ) {
        $this->response = $response;
        $this->request = $request;
    }

    /**
     * Display a listing of the resource.
     *
     * @param $modelName
     * @return \Illuminate\Contracts\Routing\ResponseFactory
     */
    public function index($modelName)
    {
        $this->model = resolve($modelName);
        try {
            if (in_array($this->orderByField, $this->model->getColumns())) {
                $results = $this->model->getAll('*', $this->orderByField, 'asc');
            } else {
                $results = $this->model->getAll('*', 'id', 'desc');
            }
            return $this->response->respond(200, 'Success', $results);
        } catch (\Exception $exception) {
            Log::error('Error get APIController index: '.$exception);
            return $this->response->respond(0, $exception, null);
        }
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
     * @param  $modelName
     * @return \Illuminate\Contracts\Routing\ResponseFactory
     */
    public function store($modelName, Request $request)
    {
        $this->model = resolve($modelName);
        $data = $request->all();
        try {
            $data['created_at'] = Carbon::now();
            $data['updated_at'] = Carbon::now();
            $id = $this->model->insertGetId($data);
            $data['id'] = $id;
            return $this->response->respond(200, 'Create Success', $data);
        }catch (\Exception $exception) {
            Log::error('Error APIController store: '.$exception);
            return $this->response->errorInternalError();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $modelName
     * @param  int  $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory
     */
    public function show($modelName, $id)
    {
        $this->model = resolve($modelName);
        try {
            $result = $this->model->findById($id);
            return $this->response->respond(200, 'Show Success', $result);
        } catch (ModelNotFoundException $ex) {
            return $this->response->errorNotFound();
        } catch (\Exception $exception) {
            Log::error('Error APIController show: '.$exception);
            return $this->response->errorInternalError();
        }

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
     * @param  $modelName
     * @return \Illuminate\Contracts\Routing\ResponseFactory
     */
    public function update($modelName, Request $request, $id)
    {
        $this->model = resolve($modelName);
        $data = $request->all();
        try {
//            $id = $request['id'];
            $this->model->updateObj($data, $id);
            return $this->response->respond(200, 'Update success', $data);
        } catch (\Exception $exception) {
            Log::error('Error APIController update: '.$exception);
            return $this->response->errorInternalError();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  $modelName
     * @return \Illuminate\Contracts\Routing\ResponseFactory
     */
    public function destroy($modelName, $id)
    {
        $this->model = resolve($modelName);
        try {
            $this->model->destroy($id);
            return $this->response->respond(200, 'Destroy Success', null);
        } catch (\Exception $exception) {
            Log::error('Error APIController destroy: '.$exception);
            return $this->response->errorInternalError();
        }
    }

    public function getDataPagination($modelName, $skip = null, $take = null)
    {
        $this->model = resolve($modelName);
        try {
            $results = $this->model->findAllByPagination($modelName, $skip, $take);
            return $this->response->respond(200, 'Success', $results);
        } catch (\Exception $exception) {
            Log::error('Error APIController pagination: '.$exception);
            return $this->response->errorInternalError();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $modelName
     * @param  int  $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory
     */
    public function showBy($modelName, $column, $id)
    {
        $this->model = resolve($modelName);
        try {
            $result = $this->model->findByAll($column, $id);
            return $this->response->respond(200, 'Show Success', $result);
        } catch (ModelNotFoundException $ex) {
            return $this->response->errorNotFound();
        } catch (\Exception $exception) {
            Log::error('Error APIController show: '.$exception);
            return $this->response->errorInternalError();
        }

    }
}
