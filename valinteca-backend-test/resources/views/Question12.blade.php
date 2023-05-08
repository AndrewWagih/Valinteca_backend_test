<!DOCTYPE html>
<html>
  <head>
    <title>Question 12:</title>
  </head>
  <body>
    <ul id="posts"></ul>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
      // Make a GET request to an API endpoint using Axios
      axios.get('https://jsonplaceholder.typicode.com/posts')
        .then(function(response) {
            const posts = response.data;
            let list = document.getElementById('posts');
            posts.forEach(function(posts) {
                const listItem = document.createElement('li');
                listItem.innerText = posts.title;
                list.appendChild(listItem);
            });
        })
        .catch(function(error) {
          console.log(error);
        });
    </script>
  </body>
</html>
