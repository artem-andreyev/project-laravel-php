<?php

namespace Database\Seeders;

use App\Models\Employer;
use App\Models\Job;
use App\Models\Internship;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class JobsAndInternshipsSeeder extends Seeder
{
    public function run(): void
    {
        $employersData = [
            ['name' => 'Accenture Latvia',           'address' => 'Skanstes iela 13, Rīga',                'lat' => 56.9689, 'lng' => 24.1210],
            ['name' => 'Printful Latvia',             'address' => 'Gustava Zemgala gatve 78, Rīga',        'lat' => 56.9750, 'lng' => 24.1580],
            ['name' => 'Latvijas Gāze',               'address' => 'Vagonu iela 20, Rīga',                  'lat' => 56.9360, 'lng' => 24.0980],
            ['name' => 'Lattelecom',                  'address' => 'Dzirnavu iela 105, Rīga',               'lat' => 56.9530, 'lng' => 24.1270],
            ['name' => 'Grindex',                     'address' => 'Krustpils iela 53, Rīga',               'lat' => 56.9210, 'lng' => 24.1950],
            ['name' => 'Daugavpils Universitāte',     'address' => 'Vienības iela 13, Daugavpils',          'lat' => 55.8794, 'lng' => 26.5067],
            ['name' => 'Liepājas metalurgs',          'address' => 'Brīvības iela 76, Liepāja',             'lat' => 56.5050, 'lng' => 21.0100],
            ['name' => 'Jelgavas novads',             'address' => 'Pasta iela 37, Jelgava',                'lat' => 56.6523, 'lng' => 23.7210],
            ['name' => 'Valmiera Glass',              'address' => 'Cempu iela 13, Valmiera',               'lat' => 57.5380, 'lng' => 25.4320],
            ['name' => 'Cēsu alus',                   'address' => 'Aldaru iela 1, Cēsis',                  'lat' => 57.3117, 'lng' => 25.2700],
            ['name' => 'Siguldas novads',             'address' => 'Pils iela 16, Sigulda',                 'lat' => 57.1530, 'lng' => 24.8530],
            ['name' => 'Tukuma tehnikums',            'address' => 'Harmonijas iela 7, Tukums',             'lat' => 56.9680, 'lng' => 23.1610],
            ['name' => 'Rīgas Satiksme',              'address' => 'Klīversala iela 11, Rīga',              'lat' => 56.9580, 'lng' => 24.0850],
            ['name' => 'Latvijas Pasts',              'address' => 'Ziemeļu iela 10, Rīga',                 'lat' => 56.9450, 'lng' => 24.1100],
            ['name' => 'Swedbank Latvia',             'address' => 'Balasta dambis 15, Rīga',               'lat' => 56.9620, 'lng' => 24.0760],
            ['name' => 'Citadele Banka',              'address' => 'Republikas laukums 2a, Rīga',           'lat' => 56.9520, 'lng' => 24.1130],
            ['name' => 'Rimi Latvia',                 'address' => 'Nīkrāces iela 5, Rīga',                'lat' => 56.9400, 'lng' => 24.1600],
            ['name' => 'Maxima Latvija',              'address' => 'Krasta iela 46, Rīga',                  'lat' => 56.9300, 'lng' => 24.1450],
            ['name' => 'LMT',                         'address' => 'Ropažu iela 6, Rīga',                   'lat' => 56.9560, 'lng' => 24.1730],
            ['name' => 'Tele2 Latvia',                'address' => 'Dzirnavu iela 67, Rīga',                'lat' => 56.9510, 'lng' => 24.1200],
            ['name' => 'Latvijas Radio',              'address' => 'Doma laukums 8, Rīga',                  'lat' => 56.9488, 'lng' => 24.1052],
            ['name' => 'Latvijas Televīzija',         'address' => 'Zaķusala, Rīga',                        'lat' => 56.9350, 'lng' => 24.1300],
            ['name' => 'Latvijas Universitāte',       'address' => 'Raiņa bulvāris 19, Rīga',              'lat' => 56.9510, 'lng' => 24.1135],
            ['name' => 'RTU',                         'address' => 'Kaļķu iela 1, Rīga',                   'lat' => 56.9470, 'lng' => 24.1060],
            ['name' => 'Rīgas Stradiņa universitāte','address' => 'Dzirciema iela 16, Rīga',               'lat' => 56.9410, 'lng' => 24.0680],
            ['name' => 'Latvijas Banka',              'address' => 'K. Valdemāra iela 2a, Rīga',           'lat' => 56.9535, 'lng' => 24.1095],
            ['name' => 'AirBaltic',                   'address' => 'Lapkalna iela 6, Mārupe',               'lat' => 56.9230, 'lng' => 23.9710],
            ['name' => 'Tet (Lattelecom)',             'address' => 'Dzirnavu iela 105, Rīga',              'lat' => 56.9530, 'lng' => 24.1270],
            ['name' => 'Latvenergo',                  'address' => 'Pulkveža Brieža iela 12, Rīga',        'lat' => 56.9545, 'lng' => 24.1390],
            ['name' => 'Augstsprieguma tīkls',        'address' => 'Dārzciema iela 86, Rīga',              'lat' => 56.9280, 'lng' => 24.1820],
            ['name' => 'Madona Municipality',         'address' => 'Saieta laukums 1, Madona',             'lat' => 56.8597, 'lng' => 26.2244],
            ['name' => 'Ogres novads',                'address' => 'Brīvības iela 33, Ogre',               'lat' => 56.8140, 'lng' => 24.5890],
            ['name' => 'Bauska Municipality',         'address' => 'Uzvaras iela 1, Bauska',               'lat' => 56.4067, 'lng' => 24.1870],
            ['name' => 'Ventspils Digital Centre',    'address' => 'Akmeņu iela 2, Ventspils',             'lat' => 57.3961, 'lng' => 21.5573],
            ['name' => 'Rēzeknes tehnoloģiju akadēmija', 'address' => 'Atbrīvošanas aleja 115, Rēzekne',  'lat' => 56.5100, 'lng' => 27.3330],
            ['name' => 'Lidosta Rīga',                'address' => 'Starptautiskā iela 1, Mārupe',         'lat' => 56.9235, 'lng' => 23.9718],
            ['name' => 'Latvijas Finieris',           'address' => 'Bauskas iela 58, Rīga',                'lat' => 56.9180, 'lng' => 24.1200],
            ['name' => 'SAF Tehnika',                 'address' => 'Ganibu dambis 24a, Rīga',              'lat' => 56.9700, 'lng' => 24.0930],
            ['name' => 'Exigen Services Latvia',      'address' => 'Elizabetes iela 45/47, Rīga',          'lat' => 56.9540, 'lng' => 24.1180],
            ['name' => 'Evolution Gaming Latvia',     'address' => 'Meistaru iela 1, Jelgava',             'lat' => 56.6530, 'lng' => 23.7300],
            ['name' => 'Nordea Latvia',               'address' => 'K. Valdemāra iela 62, Rīga',          'lat' => 56.9600, 'lng' => 24.1100],
            ['name' => 'DHL Latvia',                  'address' => 'Lidostas iela 4, Mārupe',              'lat' => 56.9250, 'lng' => 23.9800],
            ['name' => 'Deloitte Latvia',             'address' => 'Šmerļa iela 1, Rīga',                  'lat' => 56.9690, 'lng' => 24.1010],
            ['name' => 'PwC Latvia',                  'address' => 'Kr. Valdemāra iela 21, Rīga',         'lat' => 56.9570, 'lng' => 24.1090],
            ['name' => 'Kuldīgas novads',             'address' => 'Baznīcas iela 1, Kuldīga',             'lat' => 57.0000, 'lng' => 21.9731],
            ['name' => 'Alūksnes novads',             'address' => 'Dārza iela 11, Alūksne',               'lat' => 57.4267, 'lng' => 26.9856],
            ['name' => 'Balvu novads',                'address' => 'Bērzpils iela 1a, Balvi',              'lat' => 57.1330, 'lng' => 27.2650],
            ['name' => 'Saldus novads',               'address' => 'Striķu iela 3, Saldus',                'lat' => 56.6747, 'lng' => 22.4930],
            ['name' => 'Talsu novads',                'address' => 'Kareivju iela 7, Talsi',               'lat' => 57.2453, 'lng' => 22.5867],
            ['name' => 'Dobeles novads',              'address' => 'Brīvības iela 17, Dobele',             'lat' => 56.6236, 'lng' => 23.2767],
            ['name' => 'Jēkabpils novads',            'address' => 'Brīvības iela 120, Jēkabpils',        'lat' => 56.4967, 'lng' => 25.8753],
            ['name' => 'Gulbenes novads',             'address' => 'Ābeļu iela 2, Gulbene',                'lat' => 57.1744, 'lng' => 26.7511],
            ['name' => 'Limbažu novads',              'address' => 'Rīgas iela 16, Limbaži',               'lat' => 57.5019, 'lng' => 24.7139],
        ];

        $employers = [];
        foreach ($employersData as $i => $data) {
            $email = 'employer_demo_' . ($i + 1) . '@demo.lv';
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'first_name' => explode(' ', $data['name'])[0],
                    'last_name'  => 'Demo',
                    'password'   => Hash::make('password'),
                    'role'       => 'employer',
                    'email_verified_at' => now(),
                ]
            );

            $employer = Employer::firstOrCreate(
                ['user_id' => $user->id],
                ['name' => $data['name']]
            );

            $employers[] = array_merge($data, ['employer' => $employer]);
        }

        $jobs = [
            ['title' => 'PHP Backend Developer',                'salary' => '€2500–€3500', 'type' => 'full-time', 'industry' => 'IT',                  'ei' => 0,  'desc' => 'Develop and maintain large-scale web applications using PHP and Laravel.',                              'req' => 'PHP 8+, Laravel, MySQL, REST API, Git'],
            ['title' => 'React Frontend Developer',             'salary' => '€2800–€3800', 'type' => 'full-time', 'industry' => 'IT',                  'ei' => 1,  'desc' => 'Build modern e-commerce interfaces used by millions of customers worldwide.',                          'req' => 'React, TypeScript, Tailwind CSS, 2+ years experience'],
            ['title' => 'DevOps Engineer',                      'salary' => '€3000–€4500', 'type' => 'full-time', 'industry' => 'IT',                  'ei' => 0,  'desc' => 'Manage CI/CD pipelines, cloud infrastructure and monitoring systems.',                               'req' => 'Docker, Kubernetes, AWS/GCP, Linux, Terraform'],
            ['title' => 'Gas Network Technician',               'salary' => '€1400–€1900', 'type' => 'full-time', 'industry' => 'Energy',              'ei' => 2,  'desc' => 'Maintain and inspect natural gas distribution networks across Latvia.',                              'req' => 'Technical education, driver license B, Latvian language'],
            ['title' => 'Network Engineer',                     'salary' => '€2200–€3000', 'type' => 'full-time', 'industry' => 'Telecommunications',  'ei' => 3,  'desc' => 'Design and maintain fiber optic and IP telecom networks.',                                          'req' => 'Cisco CCNA, networking protocols, 2+ years experience'],
            ['title' => 'Junior Chemist',                       'salary' => '€1200–€1700', 'type' => 'full-time', 'industry' => 'Pharmaceuticals',     'ei' => 4,  'desc' => 'Work in pharmaceutical production quality control laboratory.',                                     'req' => 'Chemistry degree, laboratory experience, Latvian language'],
            ['title' => 'University Lecturer – CS',             'salary' => '€1600–€2200', 'type' => 'full-time', 'industry' => 'Education',           'ei' => 5,  'desc' => 'Teach programming and algorithms at bachelor level at Daugavpils University.',                     'req' => 'Master degree in CS or related, teaching experience preferred'],
            ['title' => 'Production Manager',                   'salary' => '€2000–€2800', 'type' => 'full-time', 'industry' => 'Manufacturing',       'ei' => 6,  'desc' => 'Oversee steel production processes and manage a team of 20+ workers.',                            'req' => 'Engineering degree, management experience, 3+ years in manufacturing'],
            ['title' => 'Administrative Coordinator',           'salary' => '€1100–€1500', 'type' => 'full-time', 'industry' => 'Public Sector',       'ei' => 7,  'desc' => 'Support municipal administration with document management and public communications.',             'req' => 'Higher education, MS Office, Latvian language C1'],
            ['title' => 'Glass Production Specialist',          'salary' => '€1500–€2100', 'type' => 'full-time', 'industry' => 'Manufacturing',       'ei' => 8,  'desc' => 'Operate and maintain glass fiber production lines.',                                              'req' => 'Technical background, ability to work in shifts'],
            ['title' => 'Marketing Manager',                    'salary' => '€1800–€2500', 'type' => 'full-time', 'industry' => 'FMCG',               'ei' => 9,  'desc' => 'Lead marketing campaigns for one of Latvia\'s most loved beer brands.',                           'req' => 'Marketing degree, social media skills, 3+ years experience'],
            ['title' => 'Tourism Guide',                        'salary' => '€900–€1300',  'type' => 'part-time', 'industry' => 'Tourism',             'ei' => 10, 'desc' => 'Guide tourists through Sigulda castle ruins and nature trails.',                                  'req' => 'Latvian and English fluency, history knowledge, friendly personality'],
            ['title' => 'Vocational Teacher – Automotive',      'salary' => '€1300–€1800', 'type' => 'full-time', 'industry' => 'Education',           'ei' => 11, 'desc' => 'Teach automotive mechanics to vocational students.',                                              'req' => 'Professional qualification in automotive, teaching certificate preferred'],
            ['title' => 'Remote Python Developer',              'salary' => '€2500–€3500', 'type' => 'remote',    'industry' => 'IT',                  'ei' => 1,  'desc' => 'Build data processing pipelines and APIs for global customers.',                                  'req' => 'Python 3, FastAPI or Django, PostgreSQL, remote work experience'],
            ['title' => 'UX/UI Designer',                      'salary' => '€2000–€2800', 'type' => 'full-time', 'industry' => 'IT',                  'ei' => 0,  'desc' => 'Design user-friendly interfaces for enterprise software products.',                               'req' => 'Figma, user research, portfolio required, 2+ years experience'],
            ['title' => 'Bus Driver',                           'salary' => '€1200–€1600', 'type' => 'full-time', 'industry' => 'Transport',           'ei' => 12, 'desc' => 'Drive city buses on Riga public transport routes.',                                             'req' => 'Category D driver license, Latvian language, clean driving record'],
            ['title' => 'Postal Courier',                       'salary' => '€900–€1200',  'type' => 'full-time', 'industry' => 'Logistics',           'ei' => 13, 'desc' => 'Deliver mail and parcels on assigned routes in Riga.',                                          'req' => 'Driver license B, physical fitness, punctuality'],
            ['title' => 'Personal Banker',                      'salary' => '€1500–€2200', 'type' => 'full-time', 'industry' => 'Finance',             'ei' => 14, 'desc' => 'Advise retail clients on banking products and financial planning.',                              'req' => 'Finance or economics degree, communication skills, Latvian and English'],
            ['title' => 'Risk Analyst',                         'salary' => '€2000–€2800', 'type' => 'full-time', 'industry' => 'Finance',             'ei' => 15, 'desc' => 'Analyze credit and market risks for corporate banking clients.',                                 'req' => 'Finance or mathematics degree, Excel, analytical mindset'],
            ['title' => 'Store Manager',                        'salary' => '€1400–€2000', 'type' => 'full-time', 'industry' => 'Retail',              'ei' => 16, 'desc' => 'Manage daily operations of a Rimi supermarket including staff and stock.',                       'req' => 'Management experience, retail background, Latvian language'],
            ['title' => 'Logistics Coordinator',                'salary' => '€1300–€1800', 'type' => 'full-time', 'industry' => 'Logistics',           'ei' => 17, 'desc' => 'Coordinate product deliveries and inventory for Maxima stores.',                                'req' => 'Logistics or supply chain background, organizational skills'],
            ['title' => 'Mobile App Developer',                 'salary' => '€2500–€3500', 'type' => 'full-time', 'industry' => 'Telecommunications',  'ei' => 18, 'desc' => 'Develop and maintain LMT mobile applications for iOS and Android.',                             'req' => 'Swift or Kotlin, 2+ years mobile dev experience, REST APIs'],
            ['title' => 'Customer Support Specialist',          'salary' => '€1000–€1400', 'type' => 'full-time', 'industry' => 'Telecommunications',  'ei' => 19, 'desc' => 'Help Tele2 customers with technical issues and service inquiries.',                              'req' => 'Good communication skills, Latvian and Russian, basic IT knowledge'],
            ['title' => 'Radio Journalist',                     'salary' => '€1200–€1700', 'type' => 'full-time', 'industry' => 'Media',               'ei' => 20, 'desc' => 'Prepare and present news programs and interviews for Latvijas Radio.',                          'req' => 'Journalism degree, excellent Latvian, microphone experience'],
            ['title' => 'Video Editor',                         'salary' => '€1400–€2000', 'type' => 'full-time', 'industry' => 'Media',               'ei' => 21, 'desc' => 'Edit news packages and documentary content for Latvijas Televīzija.',                          'req' => 'Adobe Premiere or Final Cut Pro, creative eye, deadline-driven'],
            ['title' => 'Research Assistant',                   'salary' => '€900–€1300',  'type' => 'part-time', 'industry' => 'Education',           'ei' => 22, 'desc' => 'Support academic research projects at the University of Latvia.',                               'req' => 'Bachelor degree, analytical skills, English language'],
            ['title' => 'Software Engineer',                    'salary' => '€2500–€3500', 'type' => 'full-time', 'industry' => 'IT',                  'ei' => 23, 'desc' => 'Build robust software solutions for engineering and industrial clients.',                        'req' => 'Java or C++, OOP, 2+ years experience, team player'],
            ['title' => 'Medical Researcher',                   'salary' => '€1800–€2500', 'type' => 'full-time', 'industry' => 'Healthcare',          'ei' => 24, 'desc' => 'Conduct clinical research and trials at RSU medical research centre.',                         'req' => 'Medical or biology degree, research methodology, English language'],
            ['title' => 'Economic Analyst',                     'salary' => '€2000–€2800', 'type' => 'full-time', 'industry' => 'Finance',             'ei' => 25, 'desc' => 'Analyze macroeconomic data and prepare reports for Latvijas Banka.',                           'req' => 'Economics degree, statistical tools (R/Python/Stata), English'],
            ['title' => 'Flight Attendant',                     'salary' => '€1300–€1900', 'type' => 'full-time', 'industry' => 'Aviation',            'ei' => 26, 'desc' => 'Provide excellent service and safety to airBaltic passengers.',                                 'req' => 'English fluency, minimum height 160cm, customer service mindset'],
            ['title' => 'Electrical Engineer',                  'salary' => '€2000–€2800', 'type' => 'full-time', 'industry' => 'Energy',              'ei' => 29, 'desc' => 'Maintain and develop high voltage electrical infrastructure across Latvia.',                     'req' => 'Electrical engineering degree, AutoCAD, drivers license B'],
            ['title' => 'Regional Development Officer',         'salary' => '€1300–€1800', 'type' => 'full-time', 'industry' => 'Public Sector',       'ei' => 30, 'desc' => 'Coordinate EU-funded development projects in Madona region.',                                  'req' => 'Public administration or law degree, project management, English'],
            ['title' => 'Social Worker',                        'salary' => '€900–€1300',  'type' => 'full-time', 'industry' => 'Public Sector',       'ei' => 31, 'desc' => 'Provide social care services to families and individuals in need in Ogre.',                    'req' => 'Social work degree, empathy, driving license B'],
            ['title' => 'Event Coordinator',                    'salary' => '€1000–€1500', 'type' => 'full-time', 'industry' => 'Public Sector',       'ei' => 32, 'desc' => 'Organize cultural and community events in Bauska municipality.',                               'req' => 'Event management experience, creativity, Latvian language'],
            ['title' => 'IT Systems Analyst',                   'salary' => '€2000–€2800', 'type' => 'full-time', 'industry' => 'IT',                  'ei' => 33, 'desc' => 'Analyze and improve IT infrastructure for Ventspils Digital Centre.',                         'req' => 'IT degree, Linux/Windows administration, networking knowledge'],
            ['title' => 'Lecturer – Engineering',               'salary' => '€1500–€2100', 'type' => 'full-time', 'industry' => 'Education',           'ei' => 34, 'desc' => 'Teach mechanical engineering disciplines at Rēzekne Technology Academy.',                     'req' => 'Master degree in engineering, teaching experience, Latvian language'],
            ['title' => 'Ground Operations Agent',              'salary' => '€1100–€1500', 'type' => 'full-time', 'industry' => 'Aviation',            'ei' => 35, 'desc' => 'Handle passenger check-in and baggage operations at Riga Airport.',                           'req' => 'English and Latvian fluency, customer service skills, shift work'],
            ['title' => 'Wood Processing Technologist',         'salary' => '€1600–€2200', 'type' => 'full-time', 'industry' => 'Manufacturing',       'ei' => 36, 'desc' => 'Optimize plywood production processes at Latvijas Finieris.',                                  'req' => 'Wood technology degree, production experience, technical mindset'],
            ['title' => 'RF Engineer',                          'salary' => '€2200–€3000', 'type' => 'full-time', 'industry' => 'Telecommunications',  'ei' => 37, 'desc' => 'Design and optimize microwave and radio frequency communication systems.',                      'req' => 'Electronics engineering, RF knowledge, English language'],
            ['title' => 'Java Developer',                       'salary' => '€2800–€3800', 'type' => 'full-time', 'industry' => 'IT',                  'ei' => 38, 'desc' => 'Build scalable backend services for international IT outsourcing projects.',                   'req' => 'Java 11+, Spring Boot, microservices, Docker'],
            ['title' => 'Live Game Presenter',                  'salary' => '€1200–€1800', 'type' => 'full-time', 'industry' => 'Entertainment',       'ei' => 39, 'desc' => 'Host live casino game shows broadcast to players globally.',                                   'req' => 'Excellent English, camera presence, customer service mindset'],
            ['title' => 'Compliance Officer',                   'salary' => '€2000–€3000', 'type' => 'full-time', 'industry' => 'Finance',             'ei' => 40, 'desc' => 'Ensure bank operations comply with EU financial regulations.',                                 'req' => 'Law or finance degree, knowledge of AML regulations, English'],
            ['title' => 'Freight Operations Specialist',        'salary' => '€1300–€1800', 'type' => 'full-time', 'industry' => 'Logistics',           'ei' => 41, 'desc' => 'Coordinate international air freight shipments at DHL Latvia.',                                'req' => 'Logistics background, English language, attention to detail'],
            ['title' => 'Audit Associate',                      'salary' => '€1800–€2500', 'type' => 'full-time', 'industry' => 'Finance',             'ei' => 42, 'desc' => 'Perform financial audits for Deloitte corporate and public sector clients.',                   'req' => 'Accounting or finance degree, analytical skills, English language'],
            ['title' => 'Tax Consultant',                       'salary' => '€2000–€3000', 'type' => 'full-time', 'industry' => 'Finance',             'ei' => 43, 'desc' => 'Advise clients on Latvian and EU tax law and compliance.',                                    'req' => 'Law or finance degree, tax knowledge, Latvian and English'],
            ['title' => 'Forestry Specialist',                  'salary' => '€1200–€1700', 'type' => 'full-time', 'industry' => 'Agriculture',         'ei' => 44, 'desc' => 'Manage municipal forest areas and coordinate timber harvesting in Kuldīga.',                  'req' => 'Forestry degree, outdoor work, driving license B'],
            ['title' => 'Tourism Development Officer',          'salary' => '€1100–€1600', 'type' => 'full-time', 'industry' => 'Tourism',             'ei' => 45, 'desc' => 'Develop and promote tourism routes and attractions in Alūksne region.',                       'req' => 'Tourism or marketing degree, Latvian and English, creativity'],
            ['title' => 'Social Services Coordinator',          'salary' => '€1000–€1400', 'type' => 'full-time', 'industry' => 'Public Sector',       'ei' => 46, 'desc' => 'Coordinate social support services for elderly and disabled residents in Balvi.',              'req' => 'Social work or healthcare background, empathy, organizational skills'],
            ['title' => 'Agricultural Engineer',                'salary' => '€1400–€2000', 'type' => 'full-time', 'industry' => 'Agriculture',         'ei' => 47, 'desc' => 'Support local farms with technical consultations on machinery and land use in Saldus.',        'req' => 'Agricultural engineering degree, driving license B, Latvian language'],
            ['title' => 'Museum Curator',                       'salary' => '€1000–€1500', 'type' => 'full-time', 'industry' => 'Culture',             'ei' => 48, 'desc' => 'Manage collections and organize exhibitions at Talsi regional museum.',                       'req' => 'Art history or cultural studies degree, Latvian language, attention to detail'],
            ['title' => 'Horticulture Specialist',              'salary' => '€1000–€1400', 'type' => 'full-time', 'industry' => 'Agriculture',         'ei' => 49, 'desc' => 'Oversee municipal parks and green spaces in Dobele.',                                        'req' => 'Horticulture or landscape degree, outdoor work, physical fitness'],
            ['title' => 'Civil Engineer',                       'salary' => '€1800–€2600', 'type' => 'full-time', 'industry' => 'Construction',        'ei' => 50, 'desc' => 'Oversee road and bridge construction projects in Jēkabpils region.',                         'req' => 'Civil engineering degree, AutoCAD, project management'],
            ['title' => 'GIS Analyst',                          'salary' => '€1500–€2200', 'type' => 'full-time', 'industry' => 'IT',                  'ei' => 51, 'desc' => 'Analyze geographic data and maintain maps for Gulbene municipal planning.',                   'req' => 'Geography or GIS degree, QGIS or ArcGIS, data analysis skills'],
            ['title' => 'Environmental Inspector',              'salary' => '€1200–€1700', 'type' => 'full-time', 'industry' => 'Environment',         'ei' => 52, 'desc' => 'Monitor environmental compliance of businesses in Limbaži region.',                           'req' => 'Environmental science degree, analytical skills, driving license B'],
        ];

        foreach ($jobs as $jobData) {
            $emp = $employers[$jobData['ei']];
            Job::firstOrCreate(
                [
                    'employer_id' => $emp['employer']->id,
                    'title'       => $jobData['title'],
                ],
                [
                    'salary'      => $jobData['salary'],
                    'description' => $jobData['desc'],
                    'location'    => $emp['address'],
                    'latitude'    => $emp['lat'],
                    'longitude'   => $emp['lng'],
                    'job_type'    => $jobData['type'],
                    'industry'    => $jobData['industry'],
                    'requirements'=> $jobData['req'],
                ]
            );
        }

        $internships = [
            ['title' => 'Web Development Internship',            'duration' => 3, 'ei' => 0,  'desc' => 'Learn modern web development in a professional environment working on real client projects.',           'req' => 'Basic HTML/CSS/JS knowledge, eagerness to learn'],
            ['title' => 'Marketing Internship',                   'duration' => 2, 'ei' => 1,  'desc' => 'Assist the marketing team with social media, content creation and analytics.',                         'req' => 'Marketing or communication studies, creativity'],
            ['title' => 'Chemistry Lab Internship',               'duration' => 4, 'ei' => 4,  'desc' => 'Hands-on experience in pharmaceutical quality control laboratory.',                                   'req' => 'Chemistry or pharmacy student, 3rd year or higher'],
            ['title' => 'Network Administration Internship',      'duration' => 3, 'ei' => 3,  'desc' => 'Support network engineers in configuring and monitoring telecom infrastructure.',                      'req' => 'IT studies, basic networking knowledge'],
            ['title' => 'Research Internship – Computer Science', 'duration' => 6, 'ei' => 5,  'desc' => 'Participate in academic research projects in AI and machine learning at DU.',                         'req' => 'CS student, Python knowledge, English language'],
            ['title' => 'Tourism & Events Internship',            'duration' => 2, 'ei' => 10, 'desc' => 'Help organize local tourism events and guide visitors in Sigulda.',                                   'req' => 'Tourism or hospitality studies, Latvian and English'],
            ['title' => 'Municipal Administration Internship',    'duration' => 3, 'ei' => 7,  'desc' => 'Learn public sector document management and citizen communication in Jelgava.',                       'req' => 'Law or public administration studies, Latvian language'],
            ['title' => 'Brewing & Production Internship',        'duration' => 3, 'ei' => 9,  'desc' => 'Get hands-on experience in traditional craft beer production processes.',                             'req' => 'Food technology or chemistry studies'],
            ['title' => 'Manufacturing Engineering Internship',   'duration' => 4, 'ei' => 8,  'desc' => 'Shadow production engineers and learn industrial glass fiber manufacturing in Valmiera.',             'req' => 'Materials engineering or mechanical engineering student'],
            ['title' => 'DevOps / Cloud Internship',              'duration' => 3, 'ei' => 0,  'desc' => 'Work alongside DevOps engineers on CI/CD pipelines and cloud infrastructure.',                       'req' => 'Linux basics, interest in cloud technologies, IT studies'],
            ['title' => 'Graphic Design Internship',              'duration' => 2, 'ei' => 1,  'desc' => 'Create visual assets for Printful marketplace products and marketing materials.',                     'req' => 'Graphic design studies, Adobe Creative Suite or Figma'],
            ['title' => 'Energy Sector Internship',               'duration' => 4, 'ei' => 2,  'desc' => 'Learn about natural gas distribution and energy infrastructure management.',                         'req' => 'Energy, mechanical or civil engineering student'],
            ['title' => 'Public Transport Operations Internship', 'duration' => 3, 'ei' => 12, 'desc' => 'Support route planning and operations management at Rīgas Satiksme.',                                'req' => 'Transport or logistics studies, analytical thinking'],
            ['title' => 'Postal Logistics Internship',            'duration' => 2, 'ei' => 13, 'desc' => 'Assist in parcel sorting and last-mile delivery coordination at Latvijas Pasts.',                   'req' => 'Logistics or supply chain studies, attention to detail'],
            ['title' => 'Banking & Finance Internship',           'duration' => 3, 'ei' => 14, 'desc' => 'Support retail banking advisors and learn financial product sales at Swedbank.',                     'req' => 'Finance or economics student, 2nd year or higher'],
            ['title' => 'Financial Risk Internship',              'duration' => 3, 'ei' => 15, 'desc' => 'Assist risk analysts with data collection and model testing at Citadele.',                           'req' => 'Mathematics, statistics or finance studies'],
            ['title' => 'Retail Management Internship',           'duration' => 2, 'ei' => 16, 'desc' => 'Learn store operations management at one of Latvia\'s leading supermarket chains.',                  'req' => 'Business administration studies, proactive attitude'],
            ['title' => 'Supply Chain Internship',                'duration' => 3, 'ei' => 17, 'desc' => 'Support the logistics team with order tracking and inventory management at Maxima.',                 'req' => 'Logistics or business studies, Excel skills'],
            ['title' => 'Mobile Development Internship',          'duration' => 4, 'ei' => 18, 'desc' => 'Join LMT app development team and work on real features used by thousands of users.',               'req' => 'Mobile development studies, Swift or Kotlin basics'],
            ['title' => 'Telecom Customer Service Internship',    'duration' => 2, 'ei' => 19, 'desc' => 'Handle customer inquiries and learn telecom service processes at Tele2.',                            'req' => 'Communication studies, Latvian and English, good phone manner'],
            ['title' => 'Radio Broadcasting Internship',          'duration' => 3, 'ei' => 20, 'desc' => 'Assist journalists in content preparation and studio operations at Latvijas Radio.',                 'req' => 'Journalism or communication studies, excellent Latvian'],
            ['title' => 'TV Production Internship',               'duration' => 3, 'ei' => 21, 'desc' => 'Support video editors and directors in news and documentary production at LTV.',                    'req' => 'Media studies, creativity, attention to detail'],
            ['title' => 'University Research Internship',         'duration' => 6, 'ei' => 22, 'desc' => 'Contribute to active research projects at University of Latvia departments.',                       'req' => 'Bachelor student, research interest, English language'],
            ['title' => 'Embedded Systems Internship',            'duration' => 4, 'ei' => 23, 'desc' => 'Work with RTU engineers on embedded software for industrial applications.',                         'req' => 'Electronics or CS student, C programming basics'],
            ['title' => 'Clinical Research Internship',           'duration' => 4, 'ei' => 24, 'desc' => 'Support medical researchers in data collection and trial coordination at RSU.',                     'req' => 'Medicine, biology or pharmacy student'],
            ['title' => 'Central Bank Data Internship',           'duration' => 3, 'ei' => 25, 'desc' => 'Assist economists in data analysis and report preparation at Latvijas Banka.',                      'req' => 'Economics or statistics student, Excel/Python, English'],
            ['title' => 'Aviation Cabin Crew Internship',         'duration' => 2, 'ei' => 26, 'desc' => 'Train alongside airBaltic cabin crew and learn aviation safety and service standards.',              'req' => 'English fluency, minimum 18 years, customer service attitude'],
            ['title' => 'Plywood Production Internship',          'duration' => 3, 'ei' => 36, 'desc' => 'Observe and assist in plywood manufacturing processes at Latvijas Finieris.',                       'req' => 'Wood technology or materials student, practical mindset'],
            ['title' => 'RF Systems Internship',                  'duration' => 3, 'ei' => 37, 'desc' => 'Assist RF engineers in system testing and frequency planning at SAF Tehnika.',                      'req' => 'Electronics or telecommunications student'],
            ['title' => 'IT Outsourcing Internship',              'duration' => 4, 'ei' => 38, 'desc' => 'Join Exigen Services development teams and work on enterprise Java projects.',                      'req' => 'Java basics, OOP knowledge, CS student'],
            ['title' => 'Live Game Hosting Internship',           'duration' => 2, 'ei' => 39, 'desc' => 'Train as a live game presenter and learn professional broadcasting at Evolution.',                  'req' => 'Excellent English, confident personality, no experience needed'],
            ['title' => 'Banking Compliance Internship',          'duration' => 3, 'ei' => 40, 'desc' => 'Support compliance officers in AML checks and regulatory reporting at Nordea.',                     'req' => 'Law or finance student, attention to detail, English'],
            ['title' => 'Air Freight Internship',                 'duration' => 3, 'ei' => 41, 'desc' => 'Assist the DHL freight team with shipment coordination and customs documentation.',                 'req' => 'Logistics or international business studies, English language'],
            ['title' => 'Audit Internship',                       'duration' => 3, 'ei' => 42, 'desc' => 'Support audit teams in financial statement analysis at Deloitte Latvia.',                           'req' => 'Accounting or finance student, analytical skills'],
            ['title' => 'Tax Advisory Internship',                'duration' => 3, 'ei' => 43, 'desc' => 'Learn tax consulting processes and assist with client deliverables at PwC Latvia.',                 'req' => 'Law or finance student, 3rd year or higher, English'],
            ['title' => 'Forestry Management Internship',         'duration' => 4, 'ei' => 44, 'desc' => 'Assist forestry specialists with inventory and harvesting coordination in Kuldīga.',                'req' => 'Forestry or environmental science student'],
            ['title' => 'Regional Tourism Internship',            'duration' => 2, 'ei' => 45, 'desc' => 'Help develop tourism promotion materials and events for Alūksne region.',                          'req' => 'Tourism or marketing studies, creativity, Latvian and English'],
            ['title' => 'Social Services Internship',             'duration' => 3, 'ei' => 46, 'desc' => 'Shadow social workers and assist in case documentation in Balvi novads.',                          'req' => 'Social work student, empathy, Latvian language'],
            ['title' => 'Agricultural Technology Internship',     'duration' => 3, 'ei' => 47, 'desc' => 'Work with agronomists on crop monitoring and machinery maintenance in Saldus.',                    'req' => 'Agriculture or engineering student, outdoor work'],
            ['title' => 'Museum Studies Internship',              'duration' => 2, 'ei' => 48, 'desc' => 'Assist curators with collection cataloguing and exhibition preparation in Talsi.',                  'req' => 'Art history, cultural studies or museum studies student'],
            ['title' => 'Landscape Design Internship',            'duration' => 3, 'ei' => 49, 'desc' => 'Support landscape architects with park and green space planning in Dobele.',                       'req' => 'Landscape architecture or horticulture studies'],
            ['title' => 'Construction Site Internship',           'duration' => 4, 'ei' => 50, 'desc' => 'Gain practical experience on road and bridge construction projects in Jēkabpils.',                 'req' => 'Civil engineering student, safety awareness'],
            ['title' => 'GIS & Spatial Data Internship',          'duration' => 3, 'ei' => 51, 'desc' => 'Assist with geographic data collection and mapping projects in Gulbene municipality.',             'req' => 'Geography or GIS studies, QGIS basics'],
            ['title' => 'Environmental Monitoring Internship',    'duration' => 3, 'ei' => 52, 'desc' => 'Support environmental inspectors with field sampling and data entry in Limbaži.',                  'req' => 'Environmental science student, outdoor work, driving license'],
            ['title' => 'Power Systems Internship',               'duration' => 4, 'ei' => 29, 'desc' => 'Learn high voltage network operations and maintenance at Augstsprieguma tīkls.',                  'req' => 'Electrical engineering student, safety training preferred'],
            ['title' => 'IT Infrastructure Internship',           'duration' => 3, 'ei' => 28, 'desc' => 'Assist system administrators with server and network maintenance at Latvenergo.',                  'req' => 'IT student, Linux basics, networking knowledge'],
            ['title' => 'Digital Innovation Internship',          'duration' => 3, 'ei' => 33, 'desc' => 'Support smart city and digital innovation projects at Ventspils Digital Centre.',                  'req' => 'IT or innovation management studies, English language'],
            ['title' => 'Airport Operations Internship',          'duration' => 2, 'ei' => 35, 'desc' => 'Observe and assist ground operations teams at Riga International Airport.',                        'req' => 'Aviation or logistics studies, English language, shift work'],
            ['title' => 'Telecom Infrastructure Internship',      'duration' => 4, 'ei' => 27, 'desc' => 'Support field engineers in fiber optic network deployment projects across Latvia.',                 'req' => 'Telecommunications student, physical fitness, driving license'],
            ['title' => 'Public Relations Internship',            'duration' => 2, 'ei' => 22, 'desc' => 'Assist the communications team with press releases and social media at University of Latvia.',     'req' => 'Communication or PR studies, writing skills, Latvian and English'],
            ['title' => 'E-commerce Internship',                  'duration' => 3, 'ei' => 1,  'desc' => 'Support Printful e-commerce team with product listings, analytics and customer feedback.',         'req' => 'Business or marketing studies, e-commerce interest, English'],
            ['title' => 'Cloud Architecture Internship',          'duration' => 4, 'ei' => 0,  'desc' => 'Work with Accenture cloud architects on enterprise migration projects to AWS and Azure.',          'req' => 'Cloud computing interest, IT studies, English language'],
        ];

        foreach ($internships as $internData) {
            $emp = $employers[$internData['ei']];
            Internship::firstOrCreate(
                [
                    'employer_id' => $emp['employer']->id,
                    'title'       => $internData['title'],
                ],
                [
                    'duration'    => $internData['duration'],
                    'description' => $internData['desc'],
                    'location'    => $emp['address'],
                    'latitude'    => $emp['lat'],
                    'longitude'   => $emp['lng'],
                    'requirements'=> $internData['req'],
                ]
            );
        }

        $this->command->info('Created ' . count($employers) . ' employers, ' . count($jobs) . ' jobs and ' . count($internships) . ' internships across Latvia.');
    }
}
