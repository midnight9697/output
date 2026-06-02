<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PublicHearingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('public_hearings')->delete();
        
        \DB::table('public_hearings')->insert(array (
            0 => 
            array (
                'created_at' => '2026-05-28 10:05:35',
                'id' => 5,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/01/PROJECT-DESCRIPTION-1.pdf',
                'project_location' => 'Barangays Lagundi and Pangdan, City of Catbalogan, Samar',
                'project_name' => 'Spark Samar Sports City Project',
                'project_proponent' => 'Provincial Government of Samar',
                'public_hearing_location' => 'TBA',
                'tentative_date_and_time' => 'February 6, 2024; 2:00PM',
                'updated_at' => '2026-05-28 10:05:35',
            ),
            1 => 
            array (
                'created_at' => '2026-05-28 10:06:13',
                'id' => 6,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/05/Notice-of-PH-1.pdf',
                'project_location' => 'Brgy. San Agustin and Brgy. Taguite, Babatngon, Leyte',
                'project_name' => '120.002 MW Victoria Green Power Corporation Solar PV Power Plant',
                'project_proponent' => 'Victoria Green Power Corporation',
                'public_hearing_location' => 'Covered Court, Barangay San Agustin, Babatngon, Leyte',
                'tentative_date_and_time' => 'June 18, 2024; 10AM',
                'updated_at' => '2026-05-28 10:06:13',
            ),
            2 => 
            array (
                'created_at' => '2026-05-28 10:07:04',
                'id' => 7,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/06/Notice-of-PH-Mariculture-Park-Project-.pdf',
                'project_location' => 'Barangay San Juan, Ormoc City, Leyte',
                'project_name' => 'Ormoc City Mariculture Park Project',
                'project_proponent' => 'City Government of Ormoc',
                'public_hearing_location' => 'Covered Court, Barangay San Juan, Ormoc City, Leyte',
                'tentative_date_and_time' => 'June 19, 2024; 10:00AM',
                'updated_at' => '2026-05-28 10:07:04',
            ),
            3 => 
            array (
                'created_at' => '2026-05-28 10:07:33',
                'id' => 8,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/07/Notice-of-PH.pdf',
                'project_location' => 'Buri Island to Magcasongyao Islet, Barangay Cabugawan,
Catbalogan City, Samar',
                'project_name' => 'Catbalogan Airport Development Project – Reclamation',
                'project_proponent' => 'Provincial Government of Samar',
                'public_hearing_location' => 'Barangay Cabugawan Covered Court in Buri Island, Catbalogan City, Samar',
                'tentative_date_and_time' => 'July 17, 2024; 9:00AM',
                'updated_at' => '2026-05-28 10:07:33',
            ),
            4 => 
            array (
                'created_at' => '2026-05-28 10:08:22',
                'id' => 9,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/12/EIS-WLS-Poultry-Farm.pdf',
                'project_location' => 'Barangay Tinghub, Villaba, Leyte.',
                'project_name' => 'WLS Agro Macro Industries Tunnel Vent Poultry Farm Project',
                'project_proponent' => 'WLS Agro Macro Industries',
                'public_hearing_location' => 'Barangay Tinghub, Villaba, Leyte',
                'tentative_date_and_time' => 'December 17, 2024; 9:00AM',
                'updated_at' => '2026-05-28 10:08:22',
            ),
            5 => 
            array (
                'created_at' => '2026-05-28 10:08:58',
                'id' => 10,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2025/03/Notice-of-PS-PDS.pdf',
                'project_location' => 'Barangay Patag, Maydolong, Eastern Samar',
                'project_name' => 'Lower Buhid Hydroelectric Power Project',
            'project_proponent' => 'Buhid Hydroenergy Corporation (BHC)',
                'public_hearing_location' => 'Municipal Gym, Maydolong, Eastern Samar',
                'tentative_date_and_time' => 'March 7, 2025; 9:00AM',
                'updated_at' => '2026-05-28 10:08:58',
            ),
            6 => 
            array (
                'created_at' => '2026-05-28 10:10:18',
                'id' => 11,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2025/07/Notice-of-PH_EIS-Report_GWEC-Notice.pdf
https://r8.emb.gov.ph/wp-content/uploads/2025/07/Notice-of-PH_EIS-Report_GWEC_EIS-Report.pdf',
                'project_location' => 'Barangays Baay, Manuel Barral Sr., Bayo, Bugtong, Cag
anibong, Caglanipao Sur, Cagmanipis Norte, Cagmanipis Sur, Danao II, Dawo, Malaga, Pilar and
San Joaquin, Calbayog City, Samar and Barangays Caglanipao and Veriato, San Isidro, Northern
Samar.',
            'project_name' => 'Gemini Wind Power Project (GWPP)',
            'project_proponent' => 'Gemini Wind Energy Corp. (GWEC)',
                'public_hearing_location' => 'Covered Court, Barangay Manuel Barral, Sr., Calbayog City, Samar',
                'tentative_date_and_time' => 'August 7, 2025; 9:00AM',
                'updated_at' => '2026-05-28 10:10:18',
            ),
            7 => 
            array (
                'created_at' => '2026-05-28 10:10:52',
                'id' => 12,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2026/01/Notice_Public_Scoping.pdf',
                'project_location' => 'Barangay San Andres, San Miguel, Leyte.',
                'project_name' => 'NDGC Agriventures Project',
                'project_proponent' => 'NDGC Agriventures, Inc.',
                'public_hearing_location' => 'Covered Court, Barangay Hall, Barangay San Andres, San Miguel, Leyte',
                'tentative_date_and_time' => 'February 5, 2026',
                'updated_at' => '2026-05-28 10:10:52',
            ),
        ));
        
        
    }
}