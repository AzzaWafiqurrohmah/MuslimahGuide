<?php

namespace MuslimahGuide\controller\api;

use MuslimahGuide\Config\database;
use MuslimahGuide\Exception\validationException;
use MuslimahGuide\Model\api\reminderRequest;
use MuslimahGuide\Repository\CycleEstRepository;
use MuslimahGuide\Repository\ReminderRepository;
use MuslimahGuide\Repository\SessionRepository;
use MuslimahGuide\Repository\UserRepository;
use MuslimahGuide\Service\api\reminderService;
use MuslimahGuide\trait\APIResponser;

class reminder
{
    use APIResponser;
    private ReminderRepository $reminderRepo;
    private UserRepository $userRepo;
    private SessionRepository $sessionRepo;
    private CycleEstRepository $cycleEstRepo;
    private reminderService $reminderService;

    public function __construct()
    {
        $connection = database::getConnection();
        $this->reminderRepo = new ReminderRepository($connection);
        $this->cycleEstRepo = new CycleEstRepository($connection);
        $this->userRepo = new UserRepository($connection);
        $this->sessionRepo = new SessionRepository($connection);

        $this->reminderService = new reminderService();

    }

    public function getAllReminder(){
        $request = new reminderRequest();
        $request->token = $_GET['token'];

        try {
            $data = $this->reminderService->getAll($request);
            $this->successArray($data->data, "Data tersedia");
        } catch (validationException $exception){
            $this->error($exception->getMessage());
        }
    }

    public function getById(){
        $request = new reminderRequest();
        $request->token = $_GET['token'];
        $request->reminder_id = $_GET['reminder_id'];

        try {
            $data = $this->reminderService->getById($request);
            $this->successArray($data->data, "Data tersedia");
        } catch (validationException $exception){
            $this->error($exception->getMessage());
        }
    }

    public function updateReminder(){
        $request = new reminderRequest();
        $request->token = $_POST['token'];
        $request->reminder_id = $_POST['reminder_id'];
        $request->cycleEst_id = $_POST['cycleEst_id'];
        $request->message = $_POST['message'];
        $request->reminderDays = $_POST['reminderDays'];
        $request->reminderTime = $_POST['reminderTime'];
        $request->is_on = $_POST['is_on'];

        try {
            $this->reminderService->update($request);
            $this->success("Data berhasil diupdate");
        } catch (validationException $exception){
            $this->error($exception->getMessage());
        }
    }
}