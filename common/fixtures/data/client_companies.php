<?php

$clientCount = Yii::$app->params['fixturesAmount'] ?? 100;
$companyCount = Yii::$app->params['fixturesAmount'] ?? 100;
$maxCompanyCountForClient = Yii::$app->params['maxCompanyCountForClient'] ?? 7;
$clientCompanies = [];
$excludes = [];

for ($i = 1; $i <= $clientCount; $i++) {
    $n = mt_rand(1, $maxCompanyCountForClient);
    for ($p = 1; $p <= $n; $p++) {
        $c = mt_rand(1, $companyCount);
        if (in_array($i . $c, $excludes)) {
            continue;
        }
        $clientCompanies[] = [
            'client_id' => $i,
            'company_id' => $c,
        ];
        $excludes[] = $i . $c;
    }
}

return $clientCompanies;
