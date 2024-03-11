<?php

namespace Modules\Certificate\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Certificate\Entities\Config;
use Modules\Certificate\Http\Requests\CreateConfigRequest;
use Modules\Certificate\Http\Requests\UpdateConfigRequest;
use Modules\Certificate\Repositories\ConfigRepository;
use Modules\Core\Http\Controllers\Admin\AdminBaseController;

class ConfigController extends AdminBaseController
{
    /**
     * @var ConfigRepository
     */
    private $config;

    public function __construct(ConfigRepository $config)
    {
        parent::__construct();

        $this->config = $config;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //$configs = $this->config->all();

        return view('certificate::admin.configs.index', compact(''));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('certificate::admin.configs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateConfigRequest $request
     * @return Response
     */
    public function store(CreateConfigRequest $request)
    {
        $this->config->create($request->all());

        return redirect()->route('admin.certificate.config.index')
            ->withSuccess(trans('core::core.messages.resource created', ['name' => trans('certificate::configs.title.configs')]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Config $config
     * @return Response
     */
    public function edit(Config $config)
    {
        return view('certificate::admin.configs.edit', compact('config'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Config $config
     * @param  UpdateConfigRequest $request
     * @return Response
     */
    public function update(Config $config, UpdateConfigRequest $request)
    {
        $this->config->update($config, $request->all());

        return redirect()->route('admin.certificate.config.index')
            ->withSuccess(trans('core::core.messages.resource updated', ['name' => trans('certificate::configs.title.configs')]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Config $config
     * @return Response
     */
    public function destroy(Config $config)
    {
        $this->config->destroy($config);

        return redirect()->route('admin.certificate.config.index')
            ->withSuccess(trans('core::core.messages.resource deleted', ['name' => trans('certificate::configs.title.configs')]));
    }
}
