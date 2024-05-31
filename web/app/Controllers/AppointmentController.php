<?php

namespace App\Controllers;


use App\Repositories\DayRepository;
use App\Repositories\TimeRepository;
use App\Repositories\AppointmentRepository;
use Core\Auth;

class AppointmentController extends Controller
{

    public function __construct(
        private  TimeRepository        $timeRepository,
        private  DayRepository         $dayRepository,
        private  AppointmentRepository $appointmentRepository,
        private  Auth                  $auth,
    )
    {

    }

    public function index()
    {
        $times = $this->timeRepository->getAll();
        $days = $this->dayRepository->getAll();

        $from = $days[0]['date'];
        $to = $days[count($days) - 1]['date'];
        $appointments = $this->appointmentRepository->all($from, $to);
        $currentUser = $this->auth->getUserId();


        view('appointments/index', compact('times', 'days', 'appointments', 'currentUser'));
    }

    public function reserve(int $hourId, string $date)
    {

        $exist = $this->appointmentRepository->findOne($hourId, $date);

        if ($exist && $exist['user_id'] == $this->auth->getUserId()) {
            setFlashMessage('danger', 'This time has been reserved by another person and cannot be rebooked');
        }


        if ($exist) {
            if ($this->appointmentRepository->cancel($hourId, $date)) {
                setFlashMessage('success', 'Your appointment has been successfully cancelled');
            } else {
                setFlashMessage('danger', 'The appointment was not canceled');
            }
        } else {
            if ($this->appointmentRepository->reserveAppointment($hourId, $date, $this->auth->getUserId())) {
                setFlashMessage('success', 'Appointment successfully set');
            } else {
                setFlashMessage('danger', 'The appointment was not set');
            }
        }
        header('Location: /');
    }
}