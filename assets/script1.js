async function getRecipes() {
  const ingredient = document.getElementById('ingredient').value;
  const recipesContainer = document.getElementById('recipes-container');
  const loadingIndicator = document.getElementById('loading-indicator');
  const nothingFilteredMessage = document.getElementById('nothing-filtered');

  try {
    if (loadingIndicator) {
      loadingIndicator.style.display = 'block';
    }

    // Construct the API URL
    const apiUrl = `https://www.themealdb.com/api/json/v1/1/filter.php?i=${ingredient}`;
    console.log('API URL:', apiUrl);

    // Make the API request
    const response = await fetch(apiUrl);

    if (!response.ok) {
      throw new Error(`HTTP error! Status: ${response.status}`);
    }

    // Parse the API response
    const responseData = await response.json();
    console.log('API Response:', responseData);

    recipesContainer.innerHTML = '';

    if (!responseData || !responseData.meals || responseData.meals.length === 0) {
      if (nothingFilteredMessage) {
        nothingFilteredMessage.style.display = 'block';
      }
      return;
    }

    const recipes = responseData.meals;

    recipes.forEach(meal => {
      const recipeElement = document.createElement('div');
      recipeElement.classList.add('recipe-card');

      recipeElement.innerHTML = `
        <h3>${meal.strMeal}</h3>
        <img src="${meal.strMealThumb}" alt="${meal.strMeal}" class="recipe-image">
        <div class="recipe-details">
          <p class="recipe-info">Category: ${meal.strCategory}</p>
          <p class="recipe-info">Area: ${meal.strArea}</p>
          <p class="recipe-info">Instructions: ${meal.strInstructions}</p>
          <a href="${meal.strYoutube}" target="_blank" class="recipe-link">Watch Video</a>
        </div>
      `;
      recipesContainer.appendChild(recipeElement);
    });

    if (nothingFilteredMessage) {
      nothingFilteredMessage.style.display = 'none';
    }

    if (loadingIndicator) {
      loadingIndicator.style.display = 'none';
    }
  } catch (error) {
    console.error('Error fetching recipes:', error);

    if (nothingFilteredMessage) {
      nothingFilteredMessage.style.display = 'none';
    }

    if (loadingIndicator) {
      loadingIndicator.style.display = 'none';
    }

    if (recipesContainer) {
      recipesContainer.innerHTML = `<p>Error fetching recipes. ${error.message}</p>`;
    }
  }
}
