<?php

namespace app\extensions;

use app\models as M;
use Yii;
use yii\base\ExitException;
class Exchange
{
    public function getRates($value, $dateStart, $dateEnd = false) {
        try {
            if (!$value || !$dateStart)
                return false;

            $cache = Yii::$app->cache;
            if ($dateEnd) {
                if ($cache->exists($value . $dateStart . $dateEnd))
                    return $cache->get($value . $dateStart . $dateEnd);
                $rates = M\Exchange::find()
                    ->where('date >= :dStart and date <= :dEnd', [':dStart' => $dateStart, ':dEnd' => $dateEnd])
                    ->all();

                if ($rates) {

                    $res = [];
                    foreach ($rates as $r) {
                        $res[$r['date']] = ($r['rate'] * $value);
                    }
                    $cache->set($value . $dateStart . $dateEnd, $res);
                    return $res;
                }
            }

            if (!empty($dateStart)) {
                if ($cache->exists($value . $dateStart))
                    return $cache->get($value . $dateStart);

                $rate = M\Exchange::find()
                    ->where('date = :date', [':date' => $dateStart])
                    ->one();

                if ($rate) {
                    $res = [$dateStart => ($rate['rate'] * $value)];
                    $cache->set($value . $dateStart . $dateEnd, $res);
                    return $res;
                }
            }
            return false;
        } catch (ExitException $e){
            Yii::error('error');
        }
    }
}