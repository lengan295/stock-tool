<?php


namespace App\Application\Actions\Homepage;


use anlutro\cURL\cURL;
use App\Application\Actions\Action;
use App\Domain\Company\Company;
use App\Domain\Company\CompanyDataUpdater;
use App\Domain\Company\CompanyHistoricalData;
use App\Infrastructure\FinfoVndSdk\ApiClient;
use Psr\Http\Message\ResponseInterface as Response;

class HomepageAction extends Action {

    /**
     * {@inheritdoc}
     */
    protected function action(): Response {
        $api = new ApiClient($this->logger, new cURL());

//        $codes = 'HDG,E29,TN1,FTI,KOS,VRE,TIP,TCH,HGR,TID,BCM,HPI,EIN,HD2,LDG,HGC,AGG,SZB,HD3,PWA,ILB,HPX,NRC,VPI,SNZ,CER,HTT,BAX,SID,PNT,NVL,HU6,HD8,CRE,HIZ,PLA,HRB,LEC,BDP,HBI,LAI,BVL,HD6,SIP,FIR,DCH,IDC,DTI,SGR,VHM,MH3,NTC,BII,SII,NHN,FLC,FIT,NLG,CEO,HAR,VNN,CCL,DIH,CIG,NDN,D11,SDI,HPR,C21,FDC,ASM,DXG,TIX,CSC,HDC,ITC,SDU,LGL,VPH,VNI,D2D,DIG,BCI,NBB,HAG,SZL,VIC,RCL,NTL,KBC,KHA,CII,UNI,SJS,TDH,ITA,PXL,PFL,SCR,KAC,HQC,TIG,OCH,IDJ,QCG,VRC,DRH,STL,CLG,PDR,PFV,DTA,PVR,OGC,VCR,NTB,DLR,IDV,TNT,NVT,PVL,PPI,NVN,LHG,KDH';
//        $codeList = explode(',', $codes);
//
//        $u = new CompanyDataUpdater($this->entityManager, $api);
//
//        foreach ($codeList as $code) {
//            $u->updateCompanyData($code);
//            $this->entityManager->flush();
//        }

        $this->response->getBody()->write('Done!');
        return $this->response;
    }
}
