<?php
function daysOfWeek($day){
    $dayOfWeek = ['یکشنبه','دوشنبه','سه شنبه','چهارشنبه','پنجشنبه','جمعه','شنبه'];
    return $dayOfWeek[$day];
}

$indexedAppointments = [];
foreach ($appointments as $appointment){
    $index = $appointment['time_id'] . '_' . $appointment['date'];
    $indexedAppointments[$index] = $appointment['user_id'];
}

layout('header');
?>

<h2>تقویم قرار ملاقات</h2>
<table class="appointmentTable">
    <thead>
        <tr>
            <th></th>
            <?php foreach ($days as $dayindex => $day): ?>
            <th <?php if($dayindex == 0): ?> class="today" <?php endif; ?> >
                <div class="appointmentDate"><?= substr($day["date"],8,2) ?></div>
                <div class="appointmentDay"><?= daysOfWeek($day["day"]) ?></div>
            </th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($times as $time): ?>
        <tr>
            <td class="appointmentTime"><?= $time['title'] ?></td>
            <?php foreach ($days as $day): ?>
            <?php
            $index = $time['id'] . '_' . $day['date'];
            if(!isset($indexedAppointments[$index])): ?>
            <td class="notReserved" onclick="appointment(<?= $time["id"] ?>,'<?= $day["date"] ?>');" title="click for set appointment">
            </td>
            <?php elseif(isset($indexedAppointments[$index]) && $indexedAppointments[$index] == $currentUser): ?>
            <td class="reservedByMe" onclick="appointment(<?= $time["id"] ?>,'<?= $day["date"] ?>');" title="click for cancel">
            </td>
            <?php elseif(isset($indexedAppointments[$index]) && $indexedAppointments[$index] != $currentUser): ?>
            <td class="reservedByAnother" title="not bookable">
            </td>
            <?php endif; ?>
            <?php endforeach; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script type="text/javascript">
    function appointment(timeId, date){
        window.location.href = '/appointments/' + timeId + '/' + date + '/reserve';
    }
</script>
</body>
</html>