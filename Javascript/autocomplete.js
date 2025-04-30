// Store selected place details for pickup and drop locations
let pickupPlace = {};
let dropPlace = {};

// Initialize Google Places Autocomplete for input fields
function initAutocomplete() {
    // Get input fields
    const pickupInput = document.getElementById('pickup');
    const dropInput = document.getElementById('drop');

    // Autocomplete options to restrict to India and get necessary fields
    const options = {
        componentRestrictions: { country: "in" }, // Restrict to India
        fields: ["place_id", "formatted_address", "geometry"] // Get place ID, address, and location geometry
    };

    // Setup autocomplete for pickup location
    const pickupAutocomplete = new google.maps.places.Autocomplete(pickupInput, options);
    pickupAutocomplete.addListener('place_changed', function () {
        const place = pickupAutocomplete.getPlace();
        pickupPlace = {
            id: place.place_id,
            address: place.formatted_address,
            location: place.geometry.location
        };
    });

    // Setup autocomplete for drop location
    const dropAutocomplete = new google.maps.places.Autocomplete(dropInput, options);
    dropAutocomplete.addListener('place_changed', function () {
        const place = dropAutocomplete.getPlace();
        dropPlace = {
            id: place.place_id,
            address: place.formatted_address,
            location: place.geometry.location
        };
    });
}

// Handle form submission
document.getElementById('bookingForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent default form submission

    // Check if both pickup and drop locations are selected
    if (!pickupPlace.id || !dropPlace.id) {
        alert("Please select valid pickup and drop locations from suggestions.");
        return;
    }

    // Create a new Distance Matrix Service instance
    const service = new google.maps.DistanceMatrixService();

    // Request distance and duration data
    service.getDistanceMatrix(
        {
            origins: [pickupPlace.location],
            destinations: [dropPlace.location],
            travelMode: google.maps.TravelMode.DRIVING,
            unitSystem: google.maps.UnitSystem.METRIC,
        },
        function (response, status) {
            if (status !== "OK") {
                alert("Error was: " + status);
                return;
            }

            // Extract relevant data from response
            const result = response.rows[0].elements[0];
            const distance = result.distance.text;
            const duration = result.duration.text;

            // Display the result
            document.getElementById('result').innerHTML = `
                <strong>Booking Details:</strong><br>
                <strong>Pickup:</strong> ${pickupPlace.address} <br>
                <strong>Drop:</strong> ${dropPlace.address} <br>
                <strong>Distance:</strong> ${distance} <br>
                <strong>Estimated Travel Time:</strong> ${duration} <br>
            `;
        }
    );
});
