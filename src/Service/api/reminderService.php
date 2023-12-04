<?php

namespace MuslimahGuide\Service\api;

use MuslimahGuide\Config\database;
use MuslimahGuide\Exception\validationException;
use MuslimahGuide\Model\api\reminderRequest;
use MuslimahGuide\Model\api\reminderResponse;
use MuslimahGuide\Repository\CycleEstRepository;
use MuslimahGuide\Repository\ReminderRepository;
use MuslimahGuide\Repository\SessionRepository;

class reminderService
{
    private SessionRepository $sessionRepo;
    private ReminderRepository $reminderRepo;
    private CycleEstRepository $cycleEstRepo;
    public function __construct()
    {
        $connection = database::getConnection();
        $this->sessionRepo = new SessionRepository($connection);
        $this->reminderRepo = new ReminderRepository($connection);
        $this->cycleEstRepo = new CycleEstRepository($connection);
    }

    public function getAll(reminderRequest $request) :reminderResponse{
        $session = $this->sessionRepo->getById($request->token);
        if($session == null){
            throw new validationException("Token tidak valid");
        }

        $data = $this->reminderRepo->getAll($session->getUserId()->getId());
        if($data == null){
            throw new validationException("Data tidak tersedia");
        }

        $response = new reminderResponse();
        $response->data = $data;
        return $response;
    }

    public function getById(reminderRequest $request) : reminderResponse{
        $session = $this->sessionRepo->getById($request->token);
        if($session == null){
            throw new validationException("Token tidak valid");
        }

        $data = $this->reminderRepo->getByIdAPI($request->reminder_id);
        if($data == null){
            throw new validationException("reminder ID tidak ditemukan");
        }

        $response = new reminderResponse();
        $response->data = $data;
        return $response;
    }

    public function update(reminderRequest $request) :bool{

        $session = $this->sessionRepo->getById($request->token);
        if($session == null){
            throw new validationException("Token tidak valid");
        }

        $cycleEst = $this->cycleEstRepo->getById($request->cycleEst_id);
        if($cycleEst == null){
            throw new validationException("cycle est ID tidak ditemukan");
        }
        $cycleEst->setId($request->cycleEst_id);


        $reminder = $this->reminderRepo->getById($request->reminder_id);
        if($reminder == null){
            throw new validationException("reminder ID tidak ditemukan");
        }

        $reminder->setReminderId($request->reminder_id);
        $reminder->setMessage($request->message);
        $reminder->setReminder($request->reminderDays);
        $reminder->setTime($request->reminderTime);
        $reminder->setIsOn($request->is_on);
        $reminder->setCycleEst($cycleEst);

        $this->reminderRepo->update($reminder);
        return true;
    }
}