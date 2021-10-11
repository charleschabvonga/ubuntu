<?php

namespace App\Services;

use App\Repositories\AgentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AgentService implements IService
{
    /**
     * @var AgentRepository agentRepository
     */
    private $agentRepository;

    /**
     * AgentService constructor.
     *
     * @param AgentRepository $agentRepository
     */
    public function __construct(AgentRepository $agentRepository)
    {
        $this->agentRepository = $agentRepository;
    }

    /**
     * Get all agents.
     *
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->agentRepository->all();
    }

    /**
     *
     * @param array $data
     * @return Model|null
     */
    public function save(array $data): ?Model
    {
        return $this->agentRepository->save($data);
    }

    /**
     * @param Model $agent
     * @param array $data
     * @return mixed
     */
    public function update(Model $agent, array $data): ?Model
    {
        return $this->agentRepository->update($agent, $data);
    }

    /**
     * @param Model $agent
     * @return mixed
     * @throws \Exception
     */
    public function delete(Model $agent): ?bool
    {
        return $this->agentRepository->delete($agent);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find(int $id): ?Model
    {
        return $this->agentRepository->find($id);
    }
}
