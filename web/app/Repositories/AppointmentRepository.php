<?php

namespace App\Repositories;


class AppointmentRepository extends Repository
{
    protected string $table = "appointments";

    public function all($from, $to)
    {
        return $this->db->getAll("SELECT * FROM appointments WHERE `date` >= '$from' OR `date` <= $to");
    }

    public function findOne(int $timeId, string $date)
    {
        return $this->db->getOne("SELECT id, user_id FROM appointments WHERE time_id = $timeId AND date = '$date'");
    }

    public function reserveAppointment(int $timeId, string $date, int $userId): int
    {
        return $this->db->insert("INSERT INTO appointments (time_id,date,user_id) VALUES (:timeId,:date,:userId)", [
            ':timeId' => $timeId,
            ':date' => $date,
            ':userId' => $userId,
        ]);
    }

    public function cancel(int $timeId, string $date): int
    {
        return $this->db->execute("DELETE FROM appointments WHERE time_id = :timeId AND date = :date", [
            ':timeId' => $timeId,
            ':date' => $date,
        ]);
    }


}