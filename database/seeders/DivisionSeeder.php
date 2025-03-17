<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        DB::table('divisions')->delete();
        // DIVISIONS
        DB::table("divisions")->insert([
            'division' => "OFFICE OF THE REGIONAL DIRECTOR",
            'acronym' => "ORD",
        ]);
        
        DB::table("divisions")->insert([
            'division' => "FINANCE AND ADMINISTRATIVE DIVISION",
            'acronym' => "FAD",
        ]);
        
        DB::table("divisions")->insert([
            'division' => "CLEARANCE AND PERMITTING DIVISION",
            'acronym' => "CPD",
        ]);

        DB::table("divisions")->insert([
            'division' => "ENVIRONMENTAL MONITORING AND ENFORCEMENT DIVISION",
            'acronym' => "EMED",
        ]);

        DB::table('sections')->delete();

        // SECTION (ORD)
        $this->insertSection(1, "LEGAL UNIT", "LEGAL");
        $this->insertSection(1, "ENVIRONMENTAL EDUCATION AND INFORMATION UNIT", "EEIU");
        $this->insertSection(1, "PLANNING AND INFORMATION SYSTEMS UNIT", "PISMU");
        $this->insertSection(1, "PROVINCIAL ENVIRONMENTAL MANAGEMENT UNIT (LEYTE)", "PEMU");
        $this->insertSection(1, "PROVINCIAL ENVIRONMENTAL MANAGEMENT UNIT (SOUTHERN LEYTE)", "PEMU");
        $this->insertSection(1, "PROVINCIAL ENVIRONMENTAL MANAGEMENT UNIT (SAMAR", "PEMU");
        $this->insertSection(1, "PROVINCIAL ENVIRONMENTAL MANAGEMENT UNIT (EASTERN SAMAR)", "PEMU");
        $this->insertSection(1, "PROVINCIAL ENVIRONMENTAL MANAGEMENT UNIT (NORTHERN SAMAR)", "PEMU");

        // SECTION (FAD)
        $this->insertSection(2, "FINANCE UNIT", "FINANCE");
        $this->insertSection(2, "ADMINISTRATIVE UNIT", "ADMINISTRATIVE");

        // SECTION (CPD)
        $this->insertSection(3, "TOXIC CHEMICALS AND HAZARDOUZ WASTE PERMITTING UNIT", "TCHWPU");
        $this->insertSection(3, "AIR AND WATER WASTE PERMETTING SECTION", "AWPS");
        $this->insertSection(3, "ENVIRONMENTAL IMPACT ASSESSMENT PERMITTING SECTION", "EIAPS");
        
        // SECTION (EMED)
        $this->insertSection(4, "SOLID WASTE MANAGEMENT SECTION", "SWM");
        $this->insertSection(4, "AMBIENT MONITORING SECTION", "AMS");
        $this->insertSection(4, "AIR AND WATER MONITORING SECTION", "AWMS");
        $this->insertSection(4, "TOXIC CHEMICALS AND HAZARDOUS MONITORING SECTION", "TCHMS");
    }

    public function insertSection($division, $section, $acronym) {
        DB::table("sections")->insert([
            'division_id' => $division,
            'section' => $section,
            'acronym' => $acronym,
        ]);
    }
}
