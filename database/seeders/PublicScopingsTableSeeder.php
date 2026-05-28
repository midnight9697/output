<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PublicScopingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('public_scopings')->delete();
        
        \DB::table('public_scopings')->insert(array (
            0 => 
            array (
                'created_at' => NULL,
                'id' => 1,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2021/08/PD-for-Scoping_PLDT-Region-8-.pdf',
                'project_location' => 'Brgy.Mabuhay, Municipality of San Isidro, Province of Northern Samar',
            'project_name' => 'PROPOSED PLDTDOMESTIC SUBMARINE CABLE AREA 1 (DSCA1) PROJECT – REGION VIII',
                'project_proponent' => 'PLDT, Inc.',
                'public_scoping_location' => NULL,
                'tentative_date_and_time' => 'September 9, 2021',
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'created_at' => NULL,
                'id' => 2,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2023/09/NOTICE-San-Isidro-Wind-Power-Project-.pdf',
                'project_location' => 'Brgys. Barangays Salvacion, San Juan, Palanit, Mabuhay, Veriato and Caglanipao, Municipality of San Isidro, Northern Samar.',
                'project_name' => 'San Isidro Wind Power Project',
                'project_proponent' => 'Lihangin Wind Energy Corp.',
                'public_scoping_location' => 'San Isidro Gymnasium,Poblacion Sur, San Isidro,Northern Samar',
                'tentative_date_and_time' => 'September 20, 2023',
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'created_at' => NULL,
                'id' => 3,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/01/PROJECT-DESCRIPTION.pdf',
                'project_location' => 'San Vicente, Catbalogan City',
                'project_name' => 'Proposed Sanitary Landfill Facility Project',
                'project_proponent' => 'MetroWaste Solid Waste Management Corporation',
                'public_scoping_location' => '2nd Floor, City Hall, City of Catbalogan',
                'tentative_date_and_time' => 'February 7, 2024; 10:00AM',
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'created_at' => NULL,
                'id' => 4,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/02/PDS-Buhid-Hydroenergy-Corporation.pdf',
                'project_location' => 'Barangay Patag, Maydolong, Eastern Samar',
                'project_name' => 'Lower Buhid Hydroelectric Power Project',
                'project_proponent' => 'Buhid Hydroenergy Corporation',
                'public_scoping_location' => 'TBA',
                'tentative_date_and_time' => 'March 12, 2024',
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'created_at' => NULL,
                'id' => 5,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/02/PDS-MEGASHIP-BUILDERS-INC.pdf',
                'project_location' => 'Barangay Balugo, Municipality of Albuera, Leyte',
            'project_name' => 'Ship Building with Port Facility (Expansion) Project',
                'project_proponent' => 'Megaship Builders Inc.',
                'public_scoping_location' => 'TBA',
                'tentative_date_and_time' => 'March 14, 2024',
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'created_at' => NULL,
                'id' => 6,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/02/PDS-Fr.-Eduardo-Celiz-OAR.pdf',
                'project_location' => 'Barangay Bantigue, Ormoc City, Leyte',
                'project_name' => 'University of San Jose Recoletos – Ormoc Campus Project',
                'project_proponent' => 'Fr. Eduardo Celiz, OAR',
                'public_scoping_location' => 'TBA',
                'tentative_date_and_time' => 'March 14, 2024',
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'created_at' => NULL,
                'id' => 7,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/04/PDS-Ormoc-Estuary_merged.pdf',
                'project_location' => 'Sitio Quintolimbo, Brgy. Naungan, Ormoc City, Leyte',
            'project_name' => 'Ormoc Estuary Park (Suroyan) Project',
                'project_proponent' => 'Premiumlands Corporation',
                'public_scoping_location' => 'Brgy. Gym,  Brgy. Naungan, Ormoc City, Leyte',
            'tentative_date_and_time' => 'May 9, 2024; 8:00AM (DEFERRED)',
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'created_at' => NULL,
                'id' => 8,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/05/Suroyan-Ecopark-PS.pdf',
                'project_location' => 'Sitio Quintolimbo, Brgy. Naungan, Ormoc City, Leyte',
            'project_name' => 'Ormoc Estuary Park (Suroyan) Project',
                'project_proponent' => 'Premiumlands Corporation',
                'public_scoping_location' => 'Brgy. Gym,  Brgy. Naungan, Ormoc City, Leyte',
                'tentative_date_and_time' => 'May 28, 2024; 8:00AM',
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'created_at' => NULL,
                'id' => 9,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/05/Suroyan-Ecopark-PS.pdf',
                'project_location' => 'Sitio Quintolimbo, Brgy. Naungan, Ormoc City, Leyte',
            'project_name' => 'Ormoc Estuary Park (Suroyan) Project',
                'project_proponent' => 'Premiumlands Corporation',
                'public_scoping_location' => 'Brgy. Gym,  Brgy. Naungan, Ormoc City, Leyte',
                'tentative_date_and_time' => 'May 28, 2024; 8:00AM',
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'created_at' => NULL,
                'id' => 10,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/07/Samar-%E2%80%93-Basey-Samar-Road-Project.pdf',
                'project_location' => 'Barangays Del Pilar, Tagalian and San Gabriel, Maydolong, Eastern Samar to Barangay Guirang, Basey, Samar ',
                'project_name' => 'Maydolong, Eastern Samar – Basey, Samar Road Project',
                'project_proponent' => 'Department of Public Works and Highways Region 8',
                'public_scoping_location' => 'Municipal Covered Court,Poblacion, Maydolong, EasternSamar',
                'tentative_date_and_time' => 'July 18, 202410:00 AMRegistration starts at 9:00 am',
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'created_at' => NULL,
                'id' => 11,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/07/Samar-%E2%80%93-Basey-Samar-Road-Project.pdf',
                'project_location' => 'Barangays Del Pilar, Tagalian and San Gabriel, Maydolong, Eastern Samar to Barangay Guirang, Basey, Samar ',
                'project_name' => 'Maydolong, Eastern Samar – Basey, Samar Road Project',
                'project_proponent' => 'Department of Public Works and Highways Region 8',
                'public_scoping_location' => 'Municipal Covered Court,Poblacion, Maydolong, EasternSamar',
                'tentative_date_and_time' => 'July 19, 202410:00 AMRegistration starts at 9:00 am',
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'created_at' => NULL,
                'id' => 12,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/07/Expansion-of-Anselma-Poultry-Farm-Project.pdf',
                'project_location' => 'Barangay LP Concepcion, Sogod, Southern Leyte',
                'project_name' => 'Expansion of Anselma Poultry Farm Project',
                'project_proponent' => 'Ms. Kirsty Mariz U. Tan',
                'public_scoping_location' => 'Barangay LP Concepcion, Sogod,Southern Leyte',
                'tentative_date_and_time' => 'July 25, 2024; 10:00AM;  Registration starts at 9:00 am',
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'created_at' => NULL,
                'id' => 13,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/08/Notice-of-PS-Sewage-Treatment-Plant-and.pdf',
                'project_location' => 'Barangay Calsadahay, Dagami, Leyte',
                'project_name' => 'Sewage Treatment Plant andTreatment, Storage And Disposal Facility Project',
                'project_proponent' => 'Soliman E. C. Septic Tank Disposal',
                'public_scoping_location' => 'Barangay Calsadahay, Dagami, Leyte',
            'tentative_date_and_time' => 'August 7, 2024; 10:00AM (Thursday); Registration starts at 9:00 am',
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'created_at' => NULL,
                'id' => 14,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/09/Gemini-Wind-Power-Project.pdf',
                'project_location' => 'Calbayog, Province of Samar, and Municipality of San Isidro, Province of Northern Samar',
                'project_name' => 'Gemini Wind Power Project',
                'project_proponent' => 'Gemini Wind Energy Corporation',
                'public_scoping_location' => 'West Prime Hotel and Restaurant, Calbayog City, Samar',
                'tentative_date_and_time' => 'September 17, 202410:00 AMRegistration starts at 9:00 am',
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'created_at' => NULL,
                'id' => 15,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/09/ilovepdf_merged_removed.pdf',
                'project_location' => 'Barangays Del Pilar, Tagalian and San Gabriel, Maydolong, Eastern Samar to Barangay Guirang, Basey, Samar',
                'project_name' => 'Maydolong, Eastern Samar – Basey, Samar Road Project',
                'project_proponent' => 'Department of Public Works and Highways Region 8',
                'public_scoping_location' => 'Municipal Covered Court, Poblacion, Basey, Samar',
            'tentative_date_and_time' => '23 September 2024 (Monday), 9:00 AM',
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'created_at' => NULL,
                'id' => 16,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/09/ilovepdf_merged_removed.pdf',
                'project_location' => 'Barangays Del Pilar, Tagalian and San Gabriel, Maydolong, Eastern Samar to Barangay Guirang, Basey, Samar',
                'project_name' => 'Maydolong, Eastern Samar – Basey, Samar Road Project',
                'project_proponent' => 'Department of Public Works and Highways Region 8',
                'public_scoping_location' => 'Municipal Covered Court, Poblacion, Maydolong, Eastern Samar',
            'tentative_date_and_time' => '24 September 2024 (Tuesday), 9:00 AM',
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'created_at' => NULL,
                'id' => 17,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/11/Final-Project-Description-Notice.pdf',
                'project_location' => 'Barangay Maca-Alang, Dagami, Leyte, Barangay Tingib, Pastrana, Leyte and Barangay Hibunawon, Jaro, Leyte',
                'project_name' => 'Treatment Facility Project',
                'project_proponent' => 'Primewater Leyte Metro',
                'public_scoping_location' => 'Barangay Hibunawon, Jaro, Leyte',
            'tentative_date_and_time' => '14 November 2024(Thursday), 9:00 AM',
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'created_at' => NULL,
                'id' => 18,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/11/Final-Project-Description-Notice.pdf',
                'project_location' => 'Barangay Maca-Alang, Dagami, Leyte, Barangay Tingib, Pastrana, Leyte and Barangay Hibunawon, Jaro, Leyte',
                'project_name' => 'Treatment Facility Project',
                'project_proponent' => 'Primewater Leyte Metro',
                'public_scoping_location' => 'Barangay Tingib, Pastrana, Leyte',
            'tentative_date_and_time' => '14 November 2024(Thursday), 2:00 PM',
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'created_at' => NULL,
                'id' => 19,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2024/11/Final-Project-Description-Notice.pdf',
                'project_location' => 'Barangay Maca-Alang, Dagami, Leyte, Barangay Tingib, Pastrana, Leyte and Barangay Hibunawon, Jaro, Leyte',
                'project_name' => 'Treatment Facility Project',
                'project_proponent' => 'Primewater Leyte Metro',
                'public_scoping_location' => 'Barangay Maca-Alang, Dagami, Leyte',
            'tentative_date_and_time' => '15 November 2024(Friday), 9:00 AM',
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'created_at' => NULL,
                'id' => 20,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2025/01/Notice-PDS-Bumagat-Agri-Ventures-Corp.-Poultry-.pdf',
                'project_location' => 'Barangay Montebello, Kananga, Leyte',
            'project_name' => 'Bumagat Agri-Ventures Corp. (Poultry & Swine) Project',
                'project_proponent' => 'Bumagat Agri-Ventures Corp.',
                'public_scoping_location' => 'Covered Court/ Barangay Hall, Barangay Montebello, Kananga, Leyte',
            'tentative_date_and_time' => '31 January 2025(Friday), 9:00 AM',
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'created_at' => NULL,
                'id' => 21,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2025/03/Notice-of-PS-PDS.pdf',
                'project_location' => 'Barangays Iniguihan, Kalanggaman and Tinago, Bato, Leyte',
                'project_name' => 'BATO RECLAMATION PROJECT',
                'project_proponent' => 'LOCAL GOVERNMENT UNIT OF BATO, LEYTE',
                'public_scoping_location' => '3rd floor Function HallMunicipal BuildingBato, Leyte',
            'tentative_date_and_time' => '31 March 2025 (Friday), 9:00AM',
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'created_at' => NULL,
                'id' => 22,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2025/04/PDS-SUN-PALO-SOLAR-ENERGY-Request-for-Public-Scoping.pdf',
                'project_location' => 'Barangay Guinciaman, San Miguel, Leyte',
                'project_name' => 'SUNPALO 250 MW SOLAR POWER PROJECT',
                'project_proponent' => 'SUNPALO SOLAR ENERGY INC.',
                'public_scoping_location' => 'Barangay Covered Court, Brgy. Guinciaman, San Miguel, Leyte',
            'tentative_date_and_time' => '11 April 2025 (Friday), 9:00AM',
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'created_at' => NULL,
                'id' => 23,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2025/05/Request-for-Public-Scoping-for-the-Land-Developmen.pdf',
                'project_location' => 'Purok 2, Poblacion, Lope de Vega, Northern Samar.',
                'project_name' => 'LAND DEVELOPMENT OF LGU – LOPE DE VEGA NEW SITE PROJECT',
                'project_proponent' => 'LOCAL GOVERNMENT UNIT OF LOPE DE VEGA, NORTHERN SAMAR',
                'public_scoping_location' => '2nd floor, Barangay Hall, Brgy. Poblacion, Lope de Vega, Northern Samar',
            'tentative_date_and_time' => '20 May 2025 (Tuesday), 9:00AM',
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'created_at' => NULL,
                'id' => 24,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2026/04/NOTICE_PDS-4PH.pdf',
                'project_location' => 'Barangay Camp Downes, Ormoc City, Province of Leyte',
            'project_name' => 'Pambansang Pabahay Para sa Pilipino (4PH)Program',
                'project_proponent' => 'LGU – Ormoc City',
                'public_scoping_location' => '4PH, Barangay Camp Downes,Ormoc City, Province of Leyte',
            'tentative_date_and_time' => 'April 06, 2026(Monday) 2:00PM',
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'created_at' => NULL,
                'id' => 25,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2026/04/NOTICE_PDS-Juaton-Sports-Complex.pdf',
                'project_location' => 'Brgy. Juaton, Ormoc City, Leyte',
                'project_name' => 'Juaton Institutional and Sports Complex',
                'project_proponent' => 'LGU – Ormoc City',
                'public_scoping_location' => 'Juaton Institutional and SportsComplex;Brgy. Juaton, Ormoc City, Leyte',
            'tentative_date_and_time' => 'April 07, 2026(Tuesday) 2:00PM',
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'created_at' => NULL,
                'id' => 26,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2026/04/NOTICE_PDS-Lake-Danao-Natural-Park.pdf',
                'project_location' => 'BarangayDanao, Ormoc City, Leyte',
                'project_name' => 'Lake Danao Natural Park',
                'project_proponent' => 'LGU – Ormoc City',
                'public_scoping_location' => 'Multipurpose Hall of BarangayDanao, Ormoc City, Leyte',
            'tentative_date_and_time' => 'April 08, 2026(Wednesday) 2:00PM',
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'created_at' => NULL,
                'id' => 27,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2026/04/NOTICE_PDS-City-College-of-Ormoc.pdf',
                'project_location' => 'BarangayBagong Buhay, Ormoc City, Leyte',
                'project_name' => 'City College of Ormoc City',
                'project_proponent' => 'LGU – Ormoc City',
                'public_scoping_location' => 'City College of Ormoc;Aunubing Street, Ormoc City,Leyte',
            'tentative_date_and_time' => 'April 07, 2026(Tuesday) 9:00AM',
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'created_at' => NULL,
                'id' => 28,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2026/04/NOTICE_PDS-Ecowaste-Facility.pdf',
                'project_location' => 'BarangayGreen Valley Ormoc City, Leyte',
                'project_name' => 'Ecowaste Facility Project',
                'project_proponent' => 'LGU – Ormoc City',
                'public_scoping_location' => 'Brgy. Green Valley Gym, OrmocCity, Leyte',
            'tentative_date_and_time' => 'April 08, 2026(Wednesday) 9:00AM',
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'created_at' => NULL,
                'id' => 29,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2026/04/GWEC_Notice_PDS.pdf',
                'project_location' => 'BarangayBugtong Covered Court, Tinambacan District, Calbayog City, Samar',
                'project_name' => 'Gemini Wind Power Project',
            'project_proponent' => 'Gemini Wind Energy Corp. (GEWC)',
                'public_scoping_location' => 'Calbayog City, Samar & San Isidro, Northern Samar',
            'tentative_date_and_time' => 'April 22, 2026(Wednesday) 9:00AM',
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'created_at' => NULL,
                'id' => 30,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2026/04/NPS-AND-DESCRIPTION-AIRPORT-EXPANSION.pdf',
                'project_location' => 'Barangay88 Tacloban City',
                'project_name' => 'Proposed Daniel Z. Romualdez Airport Expansion Project',
                'project_proponent' => 'Department of Transportation',
                'public_scoping_location' => 'Multi-Purpose Hall, Barangay 88, Tacloban',
            'tentative_date_and_time' => 'April 27, 2026(Monday) 9:00AM',
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'created_at' => NULL,
                'id' => 31,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2026/04/NPS-LEYTE-REGIONAL-PRISON-PROJECT-NOTICE-AND-DESCRIPTION.pdf',
                'project_location' => 'BarangayCabolo, Combis, Mahagna, and Nebga, Abuyog Leyte',
                'project_name' => 'Leyte Regional Prison Project',
                'project_proponent' => 'Bureau of Correction',
                'public_scoping_location' => 'Covered Court of Barangay Cagbolo, Abuyog Leyte',
            'tentative_date_and_time' => 'May 07, 2026(Thursday) 10:00AM',
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'created_at' => NULL,
                'id' => 32,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2026/04/ACES-PHILPRODUCERS-CORPORATION-PROJECT-DESCRIPTION-AND-NPS.pdf',
                'project_location' => 'BarangayNaga-asan, Babatngon, Leyte',
                'project_name' => 'Aces Philproducers Corporation Babatngon Farm Project',
                'project_proponent' => 'Aces Philproducers Corporation',
                'public_scoping_location' => 'Covered Court/Barangay Gym, Naga-asan, Babatngon, Leyte',
            'tentative_date_and_time' => 'May 05, 2026(Thursday) 10:00AM',
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'created_at' => NULL,
                'id' => 33,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2026/04/NPS-AND-PDR-PALOMPON-SLF.pdf',
                'project_location' => 'Sitio Catutuahan, Brgy. Lat-osan Palompon Leyte',
                'project_name' => 'Palompon Sanitary Landfill Category 1 Project',
                'project_proponent' => 'Local Government of Palompon',
                'public_scoping_location' => 'Palompon Sanitary Landfill, Sitio Catutuahan, Brgy. Lat-osan Palompon Leyte',
            'tentative_date_and_time' => 'May 11, 2026(Monday) 10:00AM',
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'created_at' => NULL,
                'id' => 34,
                'project_description' => 'https://r8.emb.gov.ph/wp-content/uploads/2026/04/NPS-AND-PDR-TSD.pdf',
                'project_location' => 'Eco-Park, Sitio Awo, Barangay Cantandoy Palompon, Leyte.',
            'project_name' => 'Palompon Eco-Park Center – Treatment, Storage, And Disposal (TSD) Facility Project',
                'project_proponent' => 'Local Government of Palompon',
                'public_scoping_location' => 'Palompon Eco-Park Center, Sitio Awo, Brgy. Cantandoy, Palompon Leyte',
            'tentative_date_and_time' => 'May 11, 2026(Monday) 10:00AM',
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}