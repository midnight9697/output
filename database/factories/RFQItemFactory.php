<?php

namespace Database\Factories;

use App\Models\RFQ;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RFQItem>
 */
class RFQItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        $ictSpecsSentences = [
            "Dell Latitude 5440 with Intel Core i7-1355U, 16GB RAM, 512GB SSD, 14\" FHD display, Windows 11 Pro, and 4-cell battery.",
            "HP ProDesk 400 G9 featuring Intel Core i5-13400, 8GB RAM, 1TB HDD + 256GB SSD, Intel UHD Graphics, Windows 10 Pro, and 21.5\" LED monitor.",
            "Canon imageCLASS MF455dw is a laser printer with print, copy, scan, fax functions, 40 ppm speed, duplex printing, and USB/Wi-Fi/Ethernet connectivity.",
            "TP-Link Archer AX50 supports Wi-Fi 6, dual-band (2.4GHz/5GHz), 3000 Mbps max speed, 4 LAN ports, 1 WAN, 1 USB, and WPA3 security.",
            "Logitech H390 is a wired USB headset with a noise-canceling microphone, 20Hz–20kHz frequency response, 2.3m cable, and compatibility with Windows/macOS."
        ];
        
        $rfq = RFQ::inRandomOrder()->first();
        $rfq_id = $rfq->id;
        $specs = $this->faker->randomElement($ictSpecsSentences);
        $quantity = (int)$this->faker->randomFloat(2, 1, 20);
        $price = $this->faker->randomFloat(2, 1, 1000);
        
        return [
            'rfq_id' => $rfq_id,
            'specification' => $specs,
            'bidder_specs' => '',
            'quantity_unit' =>  $quantity,
            'unit_price' =>  $price,
            'total_price' =>  ($quantity * $price),
        ];
    }
}
