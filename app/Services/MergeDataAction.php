<?php

namespace App\Services;

class MergeDataAction {
    public function handle(array $arr1, array $arr2): array {
        $collection1 = collect($arr1);
        $collection2 = collect($arr2);

        return $collection1->map(function ($item) use ($collection2) {
            $collection2Item = $collection2->where('dimensions.ad_id', $item['name'])->first();

            if (!$collection2Item) return null;

            return [
                'ad_id' => $item['name'],
                'impressions' => $collection2Item['metrics']['impressions'],
                'clicks' => $item['clicks'],
                'unique_clicks' => $item['unique_clicks'],
                'leads' => $item['leads'],
                'conversion' => $collection2Item['metrics']['conversion'],
                'roi' => $item['roi'],
            ];
        })
            ->whereNotNull()
            ->toArray();
    }
}
