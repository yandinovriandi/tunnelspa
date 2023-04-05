<?php

function generatePort($digits = 4, $previousPorts = []): string
{
    $i = 0;
    $newPort = '';

    // Generate a new port until it is unique
    while (true) {
        while ($i < $digits) {
            $newPort .= rand(1, 9);
            $i++;
        }

        // Check if the new port is already in the previousPorts array
        if (! in_array($newPort, $previousPorts)) {
            // If it is not, add the new port to the previousPorts array and return it as the result
            $previousPorts[] = $newPort;

            return $newPort;
        }

        // If it is, reset the $i counter and $newPort variable and try again
        $i = 0;
        $newPort = '';
    }
}
