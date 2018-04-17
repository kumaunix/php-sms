<script>
var chatdiv = document.getElementById('chatdiv');
setInterval(
    // Here is where to do things like dom manipulation
    function() {
        chatdiv.innerHTML = new Date;
    },

    // Here is where you set the interval asuming I want to update every 1 second
    1000
);
</script>