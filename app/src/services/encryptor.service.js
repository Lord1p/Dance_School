(function() {
  "use strict";

  angular.module("main").service("encryptor", Encryptor);

  function Encryptor() {
    this.enctypt = enctypt;

    function enctypt(key, value) {
      var result = "";
      for (let i = 0; i < value.length; ++i) {
        result += String.fromCharCode(
          key[i % key.length] ^ value.charCodeAt(i)
        );
      }
      return result;
    }
  }
})();
