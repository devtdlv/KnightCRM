<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientSeeder extends Seeder
{
    public function run(): void
    {
        $clients = [
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@techcorp.com',
                'phone' => '+1-555-0101',
                'company' => 'TechCorp Solutions',
                'address' => '123 Innovation Drive, San Francisco, CA 94105',
            ],
            [
                'name' => 'Michael Chen',
                'email' => 'mchen@designstudio.io',
                'phone' => '+1-555-0102',
                'company' => 'Design Studio',
                'address' => '456 Creative Avenue, New York, NY 10001',
            ],
            [
                'name' => 'Emily Rodriguez',
                'email' => 'emily@startupco.com',
                'phone' => '+1-555-0103',
                'company' => 'StartupCo',
                'address' => '789 Venture Street, Austin, TX 78701',
            ],
            [
                'name' => 'David Kim',
                'email' => 'david.kim@marketingpro.com',
                'phone' => '+1-555-0104',
                'company' => 'Marketing Pro',
                'address' => '321 Business Blvd, Los Angeles, CA 90001',
            ],
            [
                'name' => 'Jessica Martinez',
                'email' => 'jessica@consultinggroup.com',
                'phone' => '+1-555-0105',
                'company' => 'Strategic Consulting Group',
                'address' => '654 Executive Lane, Chicago, IL 60601',
            ],
            [
                'name' => 'Robert Taylor',
                'email' => 'rtaylor@webdev.com',
                'phone' => '+1-555-0106',
                'company' => 'WebDev Agency',
                'address' => '987 Digital Way, Seattle, WA 98101',
            ],
            [
                'name' => 'Amanda White',
                'email' => 'amanda@brandingstudio.com',
                'phone' => '+1-555-0107',
                'company' => 'Branding Studio',
                'address' => '147 Brand Street, Miami, FL 33101',
            ],
            [
                'name' => 'James Wilson',
                'email' => 'jwilson@ecommerce.com',
                'phone' => '+1-555-0108',
                'company' => 'E-Commerce Plus',
                'address' => '258 Commerce Road, Boston, MA 02101',
            ],
        ];

        foreach ($clients as $clientData) {
            Client::create($clientData);
        }
    }
}

