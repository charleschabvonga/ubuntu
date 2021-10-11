<?php

namespace App\Repositories;

use App\Models\Agent;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
Use DB;

class AgentRepository implements IRepository
{
    /**
     * Get all agents.
     *
     * @return Agent[]|Collection
     */
    public function all(): Collection
    {
        $agents = Agent::all();
        return $agents;
    }

    /**
     * @param $data
     * @return Agent
     */
    public function save(array $data): ?Model
    {
        $agent = new Agent();
        $agent = $agent->fill($data);
        $agent->save();

        return $agent->refresh();
    }

    /**
     * @param Model $agent
     * @param array $data
     * @return mixed
     */
    public function update(Model $agent, array $data): ?Model
    {
        $agent = $agent->fill($data);
        $agent->save();

        return $agent->refresh();
    }

    /**
     * @param Model $agent
     * @return mixed
     * @throws \Exception
     */
    public function delete(Model $agent): ?bool
    {
        $agent = Agent::findOrFail($agent->id);

        return $agent->delete();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find(int $id): ?Model
    {
        return Agent::findOrFail($id);
    }
}
