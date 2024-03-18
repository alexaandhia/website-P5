document.addEventListener('DOMContentLoaded', function () {
  var video = document.getElementById('myVideo');
  var successMessage = document.getElementById('successMessage');

  // Event listener for tracking video progress
  video.addEventListener('timeupdate', function () {
      // If video reaches end, set video as success
      if (video.currentTime === video.duration) {
          videoSuccess();
      }
  });

  function videoSuccess() {
      // Hide video player and show success message
      document.getElementById('videoPlayer').style.display = 'none';
      successMessage.style.display = 'block';

      // Set video time back to the beginning
      video.currentTime = 0;
  }
});

function restartVideo() {
  // Set video time back to the beginning
  video.currentTime = 0;
  // Play the video again
  video.play();
}
