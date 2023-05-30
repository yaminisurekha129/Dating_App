# Dating_App

1. Database Setup:
   - Set up a database to store user profiles and their hobbies.
   - Design the appropriate table(s) or collection(s) to store the user data.
   - Ensure you have a field to store the user's hobbies.
•	I have used Mysql and php for backend connectivity.

2. API Endpoint:
   - Create an API endpoint that accepts a GET request with the user ID as a parameter.
   - Retrieve the user profile based on the provided ID from the database.

3. Matching Algorithm:
   - Retrieve the profiles of other users from the database.
   - Calculate the compatibility score for each potential match by comparing their hobbies with the user's hobbies.
   - Sort the potential matches based on the compatibility score.

4. Response:
   - Create a response object containing the user ID and an array of potential matches.
   - For each potential match, include their ID, name, hobbies, and compatibility score.



5. API Response:
   - Return the response object as the API response, preferably in JSON format.
{
  "user_id": "1",
  "matches": [
    {
      "id": "2",
      "name": "John Doe",
      "hobbies": ["hiking", "reading", "cooking"]
    },
    {
      "id": "3",
      "name": "Jane Smith",
      "hobbies": ["painting", "traveling", "photography"]
    },
  ]
}

6. Testing:
   - Test the API endpoint by making a GET request with a valid user ID and verify that the response contains the expected potential matches ordered by compatibility.



