<?php

namespace Database\Factories;

use App\Models\Alternative;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RFQ>
 */
class RFQFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {

        $allPurposes = [
            "Office use",
            "Remote work setup",
            "Software development",
            "Graphic design",
            "Video editing",
            "Data analysis",
            "Online teaching",
            "Student learning",
            "Call center operations",
            "Inventory management",
            "Network expansion",
            "Server upgrade",
            "Virtual meetings",
            "Cybersecurity enhancement",
            "Printing official documents",
            "Staff onboarding",
            "Public Wi-Fi setup",
            "Replacement of outdated equipment",
            "Mobile workstation setup",
            "Digital transformation project",
            "Training new employees",
            "Replacing damaged equipment",
            "Expanding computer lab",
            "Upgrading performance",
            "Improving productivity",
            "Supporting hybrid work",
            "Enhancing communication",
            "Upgrading software compatibility",
            "Supporting online exams",
            "Running simulations",
            "Building IT infrastructure",
            "Launching digital marketing campaigns",
            "Managing cloud services",
            "Creating backups",
            "Designing UI/UX",
            "Hosting webinars",
            "Improving customer service",
            "Automating tasks",
            "Managing databases",
            "Integrating with ERP systems",
            "Conducting online interviews",
            "Creating e-learning content",
            "Developing mobile apps",
            "Conducting research",
            "Providing technical support",
            "Archiving records",
            "Testing hardware setups",
            "Managing social media",
            "Facilitating online banking",
            "Setting up kiosks",
            "Monitoring network traffic",
            "Creating digital signage",
            "Establishing CCTV system",
            "Handling sensitive data",
            "Securing remote connections",
            "Running AI/ML models",
            "Managing e-commerce platforms",
            "Supporting logistics operations",
            "Upgrading office technology",
            "Improving internet connectivity",
            "Recording audio content",
            "Expanding storage capacity",
            "Maintaining compliance standards",
            "Creating design prototypes",
            "Transferring large files",
            "Upgrading internal servers",
            "Enabling secure file sharing",
            "Implementing paperless processes",
            "Supporting CAD design",
            "Developing web applications",
            "Implementing firewall solutions",
            "Monitoring employee productivity",
            "Improving system uptime",
            "Running virtual machines",
            "Testing new software",
            "Increasing operational speed",
            "Configuring VPNs",
            "Streaming content",
            "Powering digital classrooms",
            "Supporting virtual reality projects",
            "Testing cybersecurity defenses",
            "Enabling mobile device management",
            "Upgrading legacy systems",
            "Scaling business operations",
            "Building helpdesk system",
            "Running financial analysis tools",
            "Deploying smart office solutions",
            "Supporting client presentations",
            "Storing surveillance footage",
            "Digitizing physical documents",
            "Analyzing customer feedback",
            "Creating digital illustrations",
            "Hosting internal wiki",
            "Monitoring environmental data",
            "Improving workflow automation",
            "Supporting point-of-sale systems",
            "Upgrading audio-visual setup",
            "Integrating cloud storage",
            "Configuring development environments",
            "Conducting system audits",
            "Creating marketing materials",
            "Managing user accounts",
            "Powering conference rooms",
            "Documenting internal processes"
        ];
        shuffle($allPurposes);

        // Pick N unique random items (e.g., 10 purposes)
        $randomPurposes = array_slice($allPurposes, 0, 10);
        $user_id = User::inRandomOrder()->first()->id;
        return [
            'project_purpose' => $this->faker->randomElement($randomPurposes),
            'rfq_number' => "101 - Planning",
            'attachment_one' => "PISMU",
            'aproved_budget' => $this->faker->randomFloat(2, 10, 1000),
            'standard_unit' => fake()->countryCode(),
            'classification' => $this->faker->randomElement(classify()),
            'creator' => $user_id,
        ];
    }
}
