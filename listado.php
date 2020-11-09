<?php

include "./db/connection.php";

$subscriptions = $dao->select("s.id as subscription_id, s.user_id as subscription_admin_id, u.email as subscription_admin")
    ->from("subscription s")
    ->join("user u on s.user_id = u.id")->toList();

include "./partials/header.php";

function getPrecioPorMes($count)
{
    if ($count < 10) return 50;
    elseif ($count < 100) return 45;
    elseif ($count < 1000) return 40;
    else return 35;
}

function getEstadoPago($state)
{
    $estado = [];
    if ($state == 'paid'){
        $estado['label'] = 'Pagado';
        $estado['class'] = 'success';
    } elseif ($state == 'pending') {
        $estado['label'] = 'Pendiente';
        $estado['class'] = '';
    }
    return $estado;
}

?>

    <div class="container py-5">
        <h1>Listado de Suscripciones</h1>
        <div class="title-bar rounded"></div>
        <?php foreach ($subscriptions as $subscription): ?>
            <hr>
            <div class="pt-3 row">
                <div class="col-12 col-sm-4">
                    <h2>Equipo #<?php echo $subscription['subscription_id']; ?></h2>
                    <p>Usuario que realizo el pago:</p>
                    <p><?php echo $subscription['subscription_admin']; ?></p>
                    <h2 class="mt-3">Suscripcion:</h2>

                    <?php
                    $users = $dao->select("u.email as user_email")->from("user_team ut")
                        ->join("user u on ut.user_id = u.id")
                        ->join("team t on ut.team_id = t.id")
                        ->join("subscription s on t.subscription_id = s.id")
                        ->where("s.id =" . $subscription['subscription_id'])->toList();
                    ?>

                    <p><?php echo count($users); ?> usuarios ($<?php echo count($users) * getPrecioPorMes(count($users)); ?> por mes)</p>
                    <h2 class="mt-3">Historial de pagos:</h2>
                    <?php
                    $billings = $dao->select("period, state, amount")->from("billing")
                        ->where("subscription_id =" . $subscription['subscription_id'])
                        ->order('period desc')->toList();
                    ?>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($billings as $billing): ?>
                            <?php $billingStates = getEstadoPago($billing['state']); ?>
                            <li class="list-group-item list-group-item-<?php echo $billingStates['class']; ?>">
                                <?php echo $billing['period'] . ' - ' . strtoupper($billingStates['label']); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="col-12 col-sm-8 mt-3 mt-md-0">
                    <h2>Usuarios en el equipo:</h2>
                    <ul class="list-group list-group-flush">
                        <?php foreach ($users as $user): ?>
                            <?php $userIsAdmin = $user['user_email'] == $subscription['subscription_admin']; ?>
                            <li class="list-group-item pl <?php echo $userIsAdmin ? 'active' : '' ?>">
                                <?php echo $userIsAdmin ? $user['user_email'] . ' (administrador)' : $user['user_email']; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


<?php
include "./partials/footer.php";
