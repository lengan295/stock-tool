<?php


namespace App\Application\Actions\Company;


use anlutro\cURL\cURL;
use App\Domain\Company\CompanyDataUpdater;
use App\Domain\DomainException\DomainRecordNotFoundException;
use App\Infrastructure\FinfoVndSdk\FinfoApiClient;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpBadRequestException;

class ImportAction extends \App\Application\Actions\Action {

    /**
     * @inheritDoc
     */
    protected function action(): Response {
        $api = new FinfoApiClient($this->logger, new cURL());

        $codes = 'L43,SCG,SZC,TS5,TS3,TA6,PCC,SCY,CC1,LMI,HEJ,PC1,GTS,BTU,PSG,RCD,DTB,HTN,LG9,DTD,VVN,LIC,C36,USC,PXC,MCT,L12,TA9,C71,SHG,NMK,UDL,XLV,S72,LLM,CC4,HTE,ACS,HC3,PVH,HFB,NAC,HGW,DCF,VWS,DPG,ROS,DT4,ICC,I10,TL4,TVH,DX2,AAV,TGG,BUD,SJG,ATB,VGV,EME,VHD,CH5,CCV,HEC,RCC,LQN,DC1,BMN,MBG,ICN,CDO,DXD,HUB,BDC,TTL,TCK,CIP,CCH,CDR,HMS,TCD,CEE,FSO,MST,BOT,C4G,QLD,TA3,VIW,C69,HHR,C12,G36,RLC,HID,HU4,VE8,VMI,VE4,PEN,SDB,VHH,FCN,ASD,QCC,NDX,HLD,VRG,S96,SCI,L14,CI5,TNY,D26,SDK,DTV,H11,PTD,BHT,VSI,GHC,MDG,SVN,CTD,LHC,V12,SHN,TKC,CT3,TNM,GTH,B82,VC6,VE9,PHC,VC9,S74,VC1,ICG,SKS,QTC,PVA,SD8,L61,LCG,DC4,VCG,VE1,TV4,CIC,CDC,C92,CMC,L62,HUT,VC5,S12,VNE,SJC,SD2,SC5,LGC,SJM,LUT,SDD,VC7,L10,VC3,SDJ,UIC,SNG,SD6,CID,HAS,MEC,PTC,S91,SDT,SD9,SJE,VMC,CTN,HBC,SIC,VC2,MCO,S99,SD3,SD5,SD7,SDC,S55,HTI,LM7,HTB,TVG,REM,DGT,PSB,JSC,HCI,SEL,S27,PVV,CVN,VE2,NHA,VCH,ND2,VE3,TBT,L44,SDH,LO5,SD4,L18,V15,DID,IME,LM3,PVX,VCT,BCE,HU1,UDC,DC2,V21,LIG,CT6,CX8,PXT,PXS,PXM,PXI,NSN,IJC,VES,PHH,CTI,SDE,L35,MCG,VPC,TV3,CTM,VCC,V11,CNT';
        $codeList = explode(',', $codes);

        $u = new CompanyDataUpdater($this->entityManager, $api);

        foreach ($codeList as $code) {
            $u->updateCompanyData($code);
            $this->entityManager->flush();
        }

        $this->response->getBody()->write('Done!');
        return $this->response;
    }
}
