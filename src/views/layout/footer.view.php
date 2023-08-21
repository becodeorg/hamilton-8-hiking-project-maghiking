</main>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const element = document.querySelector(".card");
  const elementPosition = element.getBoundingClientRect().top;
  const windowHeight = window.innerHeight;

  function activateAnimation() {
    if (elementPosition - windowHeight <= 0) {
      element.classList.add("animate");
      window.removeEventListener("scroll", activateAnimation);
    }
  }

  window.addEventListener("scroll", activateAnimation);
  activateAnimation(); // Vérifier l'état initial dès le chargement de la page
});
</script>
</body>
</html>