<?php



// Countries
$countries = array(
    'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola', 'Antigua and Barbuda', 'Argentina', 'Armenia', 'Australia', 'Austria', 
    'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bhutan', 'Bolivia', 
    'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria', 'Burkina Faso', 'Burundi', 'Cabo Verde', 'Cambodia', 'Cameroon', 
    'Canada', 'Central African Republic', 'Chad', 'Chile', 'China', 'Colombia', 'Comoros', 'Congo', 'Costa Rica', 'Croatia', 'Cuba', 
    'Cyprus', 'Czech Republic', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador', 'Equatorial Guinea', 
    'Eritrea', 'Estonia', 'Eswatini', 'Ethiopia', 'Fiji', 'Finland', 'France', 'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Greece', 
    'Grenada', 'Guatemala', 'Guinea', 'Guinea-Bissau', 'Guyana', 'Haiti', 'Honduras', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 
    'Iraq', 'Ireland', 'Israel', 'Italy', 'Jamaica', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'Kosovo', 'Kuwait', 'Kyrgyzstan', 
    'Laos', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Madagascar', 'Malawi', 'Malaysia', 
    'Maldives', 'Mali', 'Malta', 'Marshall Islands', 'Mauritania', 'Mauritius', 'Mexico', 'Micronesia', 'Moldova', 'Monaco', 'Mongolia', 
    'Montenegro', 'Morocco', 'Mozambique', 'Myanmar', 'Namibia', 'Nauru', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua', 'Niger', 
    'Nigeria', 'North Korea', 'North Macedonia', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Palestine', 'Panama', 'Papua New Guinea', 'Paraguay', 
    'Peru', 'Philippines', 'Poland', 'Portugal', 'Qatar', 'Romania', 'Russia', 'Rwanda', 'Saint Kitts and Nevis', 'Saint Lucia', 
    'Saint Vincent and the Grenadines', 'Samoa', 'San Marino', 'Sao Tome and Principe', 'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles', 
    'Sierra Leone', 'Singapore', 'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa', 'South Korea', 'South Sudan', 'Spain', 
    'Sri Lanka', 'Sudan', 'Suriname', 'Sweden', 'Switzerland', 'Syria', 'Taiwan', 'Tajikistan', 'Tanzania', 'Thailand', 'Timor-Leste', 
    'Togo', 'Tonga', 'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Tuvalu', 'Uganda', 'Ukraine', 'United Arab Emirates', 
    'United Kingdom', 'United States', 'Uruguay', 'Uzbekistan', 'Vanuatu', 'Vatican City', 'Venezuela', 'Vietnam', 'Yemen', 'Zambia', 'Zimbabwe'
    );










// PHP array for timezones
// $continents = array(
//     'Africa' => array(
//         'Africa/Abidjan' => '(GMT+00:00) Abidjan',
//         'Africa/Johannesburg' => '(GMT+02:00) Johannesburg',
//         'Africa/Nairobi' => '(GMT+03:00) Nairobi',
//     ),
//     'America' => array(
//         'America/Los_Angeles' => '(GMT-08:00) Los Angeles',
//         'America/Chicago' => '(GMT-05:00) Chicago',
//         'America/New_York' => '(GMT-04:00) New York',
//         'America/Sao_Paulo' => '(GMT-03:00) Sao Paulo',
//         'America/Mexico_City' => '(GMT-05:00) Mexico City',
//         'America/Toronto' => '(GMT-04:00) Toronto',
//     ),
//     'Antarctica' => array(
//         'Antarctica/McMurdo' => '(GMT+12:00) McMurdo Station',
//     ),
//     'Arctic' => array(
//         'Arctic/Longyearbyen' => '(GMT+01:00) Longyearbyen',
//     ),
//     'Asia' => array(
//         'Asia/Dubai' => '(GMT+04:00) Dubai',
//         'Asia/Kolkata' => '(GMT+05:30) Kolkata',
//         'Asia/Shanghai' => '(GMT+08:00) Shanghai',
//         'Asia/Tokyo' => '(GMT+09:00) Tokyo',
//         'Asia/Hong_Kong' => '(GMT+08:00) Hong Kong',
//         'Asia/Singapore' => '(GMT+08:00) Singapore',
//         'Asia/Tehran' => '(GMT+03:30) Tehran',
//     ),
//     'Atlantic' => array(
//         'Atlantic/Reykjavik' => '(GMT+00:00) Reykjavik',
//     ),
//     'Australia' => array(
//         'Australia/Sydney' => '(GMT+11:00) Sydney',
//         'Australia/Melbourne' => '(GMT+11:00) Melbourne',
//         'Australia/Brisbane' => '(GMT+10:00) Brisbane',
//     ),
//     'Europe' => array(
//         'Europe/London' => '(GMT+00:00) London',
//         'Europe/Paris' => '(GMT+01:00) Paris',
//         'Europe/Berlin' => '(GMT+01:00) Berlin',
//         'Europe/Moscow' => '(GMT+03:00) Moscow',
//         'Europe/Istanbul' => '(GMT+03:00) Istanbul',
//     ),
//     'Indian' => array(
//         'Indian/Mauritius' => '(GMT+04:00) Mauritius',
//     ),
//     'Pacific' => array(
//         'Pacific/Fiji' => '(GMT+12:00) Fiji',
//         'Pacific/Auckland' => '(GMT+13:00) Auckland',
//         'Pacific/Honolulu' => '(GMT-10:00) Honolulu',
//     ),
// );










// Get a list of all timezones
$timezones = DateTimeZone::listIdentifiers();

// Initialize an empty array to store the timezones by continent
$continents = [];

// Iterate over the list of timezones
foreach ($timezones as $timezone) {
    // Extract the continent from the timezone identifier
    $continent = explode('/', $timezone)[0];

    // Create a DateTimeZone object for the current timezone
    $dateTimeZone = new DateTimeZone($timezone);

    // Get the timezone offset in hours and minutes
    $offset = $dateTimeZone->getOffset(new DateTime()) / 3600;
    $hours = floor(abs($offset));
    $minutes = abs(($offset - $hours) * 60);

    // Format the GMT offset
    $gmtOffset = ($offset >= 0 ? '+' : '-') . sprintf('%02d:%02d', $hours, $minutes);

    // Remove the continent prefix from the timezone identifier
    $timezoneIdentifier = preg_replace('/^(.*?)\//', '', $timezone);

    // Create the timezone entry
    $timezoneEntry = "{$timezoneIdentifier} (GMT{$gmtOffset})";

    // Add the timezone entry to the continent array
    $continents[$continent][$timezone] = $timezoneEntry;
}

// Sort the timezones by continent and then by timezone identifier
foreach ($continents as &$continentTimezones) {
    ksort($continentTimezones);
}

// Sort the continents alphabetically
ksort($continents);


