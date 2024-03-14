<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://https://smartclick.agency/
 * @since      1.0.0
 *
 * @package    Smartclick_Tracker
 * @subpackage Smartclick_Tracker/admin/partials
 */

require(SMARTCLICK_TRACKER_PATH . 'includes/data-for-seo/RestClient.php');

$api_url = 'https://api.dataforseo.com/';
$client = new RestClient($api_url, null, 'branko@smartclick.mk', 'a3b110e167dcbde9');
$succeed = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $domainsInput = isset($_POST['domains']) ? $_POST['domains'] : '';
    $domains = explode("\n", $domainsInput);
    $domains = array_map('trim', array_filter($domains));

    $prevmonth = date('M Y', strtotime("-1 month"));
    $twelvemonths = date('M Y', strtotime("-12 month"));
    $post_array = array();
    $post_array[] = array(
        "targets" => $domains,
        "language_name" => "English",
        "location_code" => 2840,
        "date_from" => $twelvemonths,
        "date_to" => $prevmonth,
        "item_types" => ["organic"]
    );

    try {
        $result = $client->post('/v3/dataforseo_labs/google/historical_bulk_traffic_estimation/live', $post_array);

        $csvData = array();
        $months = array(); // To store unique months for header

        foreach (($result['tasks'] ?? []) as $task) {
            foreach (($task['result'][0]['items'] ?? []) as $item) {
                $domain = $item['target'];
                $domainRow = array($domain);

                foreach (($item['metrics']['organic'] ?? []) as $metric) {
                    $yearMonth = $metric['year'] . ' ' . $metric['month'];

                    // Collect unique months for header
                    if (!in_array($yearMonth, $months)) {
                        $months[] = $yearMonth;
                    }

                    $domainRow[] = $metric['etv'];
                }

                $csvData[] = $domainRow;
            }
        }

        $currentDate = date('d-M-Y');
        $csvFileName = "download-{$currentDate}.csv";

        $csvFile = fopen($csvFileName, 'w');

        array_unshift($months, 'Domain');
        fputcsv($csvFile, $months);

        foreach ($csvData as $row) {
            fputcsv($csvFile, $row);
        }

        fclose($csvFile);

        $succeed = true;
        
    } catch (RestClientException $e) {
        echo "Error: " . $e->getMessage();
    }

    $client = null;
}


?>

<section class="sm-tracker">
    <header class="sm-tracker__header">
        <div class="container">
            <a class="sm-tracker__header-logo" href="https://smartclick.agency/">
                <img src="<?= SMARTCLICK_TRACKER_URL . 'admin/images/smartclick-logo.png' ?>" alt="">
            </a>
        </div>
    </header>

    <div class="sm-tracker__content">
        <div class="container">
            <?php if($succeed == false) : ?>
                <h2>Enter Domain Names:</h2>
                <form method="post">
                    <textarea 
                    placeholder="smartclick.agency &#10;milansavov.com &#10;virtualstaginghub.com" required name="domains"></textarea>
                    <button class="c-btn c-btn--primary" type="submit">Submit</button>
                </form>
            <?php else : ?>
                <h2>CSV file generated successfully!</h2>
                <a class="c-btn c-btn--primary" href="<?= $csvFileName ?>">Download CSV <img class=".icon" src="<?= SMARTCLICK_TRACKER_URL . 'admin/images/download.svg' ?>" alt="download icon"> </a>
            <?php endif; ?>
        </div>
    </div>
</section>