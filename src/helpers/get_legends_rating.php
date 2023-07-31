<?php
// Function to determine the legend based on the average rating
function getRatingLegend($average_rating)
{
  if ($average_rating >= 4.5) {
    return 'Excellent';
  } elseif ($average_rating >= 3.5) {
    return 'Good';
  } elseif ($average_rating >= 2.5) {
    return 'Average';
  } elseif ($average_rating >= 1.5) {
    return 'Poor';
  } else {
    return 'Very Poor';
  }
}
