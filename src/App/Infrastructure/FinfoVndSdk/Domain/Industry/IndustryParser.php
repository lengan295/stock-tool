<?php


namespace App\Infrastructure\FinfoVndSdk\Domain\Industry;


class IndustryParser {
    public function parse($response): Industry {
        $industry = new Industry();

        if (empty($response["data"])) {
            return $industry;
        }

        $data = reset($response["data"]);

        $industry->industryCode = $data["industryCode"];
        $industry->industryLevel = $data["industryLevel"];
        $industry->higherLevelCode = $data["higherLevelCode"];
        $industry->englishName = $data["englishName"];
        $industry->vietnameseName = $data["vietnameseName"];
        $industry->totalCount = $data["totalCount"];
        $industry->codeList = $data["codeList"];

        return $industry;
    }
}
