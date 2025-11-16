<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Lead;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = ['new', 'contacted', 'qualified', 'proposal', 'negotiation', 'won', 'lost'];
        $sources = ['Website', 'Referral', 'LinkedIn', 'Cold Email', 'Trade Show', 'Social Media', 'Google Ads'];
        
        $leads = [
            [
                'name' => 'Alex Thompson',
                'email' => 'alex.thompson@newcompany.com',
                'phone' => '+1-555-0201',
                'company' => 'NewTech Innovations',
                'status' => 'new',
                'value' => 15000.00,
                'source' => 'Website',
            ],
            [
                'name' => 'Lisa Anderson',
                'email' => 'lisa@freshstart.com',
                'phone' => '+1-555-0202',
                'company' => 'Fresh Start Inc',
                'status' => 'contacted',
                'value' => 25000.00,
                'source' => 'LinkedIn',
            ],
            [
                'name' => 'Chris Brown',
                'email' => 'chris@growthlabs.com',
                'phone' => '+1-555-0203',
                'company' => 'Growth Labs',
                'status' => 'qualified',
                'value' => 35000.00,
                'source' => 'Referral',
            ],
            [
                'name' => 'Maria Garcia',
                'email' => 'maria@enterprise.com',
                'phone' => '+1-555-0204',
                'company' => 'Enterprise Solutions',
                'status' => 'proposal',
                'value' => 75000.00,
                'source' => 'Cold Email',
            ],
            [
                'name' => 'Thomas Lee',
                'email' => 'thomas@bigcorp.com',
                'phone' => '+1-555-0205',
                'company' => 'BigCorp Industries',
                'status' => 'negotiation',
                'value' => 120000.00,
                'source' => 'Trade Show',
            ],
            [
                'name' => 'Jennifer Davis',
                'email' => 'jennifer@successco.com',
                'phone' => '+1-555-0206',
                'company' => 'Success Co',
                'status' => 'won',
                'value' => 50000.00,
                'source' => 'Referral',
                'client_id' => Client::inRandomOrder()->first()->id,
            ],
            [
                'name' => 'Daniel Moore',
                'email' => 'daniel@startup.io',
                'phone' => '+1-555-0207',
                'company' => 'Startup.io',
                'status' => 'lost',
                'value' => 20000.00,
                'source' => 'Website',
            ],
            [
                'name' => 'Rachel Green',
                'email' => 'rachel@innovate.com',
                'phone' => '+1-555-0208',
                'company' => 'Innovate Labs',
                'status' => 'new',
                'value' => 18000.00,
                'source' => 'Social Media',
            ],
            [
                'name' => 'Kevin Park',
                'email' => 'kevin@digital.com',
                'phone' => '+1-555-0209',
                'company' => 'Digital Ventures',
                'status' => 'contacted',
                'value' => 28000.00,
                'source' => 'Google Ads',
            ],
            [
                'name' => 'Nicole Adams',
                'email' => 'nicole@nextgen.com',
                'phone' => '+1-555-0210',
                'company' => 'NextGen Solutions',
                'status' => 'qualified',
                'value' => 45000.00,
                'source' => 'LinkedIn',
            ],
        ];

        foreach ($leads as $leadData) {
            Lead::create($leadData);
        }
    }
}

