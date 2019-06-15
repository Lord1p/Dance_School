(function () {
  "use strict";

  angular.module("main").service("encryptor", Encryptor);

  function Encryptor() {
    this.enctypt = enctypt;

    function enctypt(value) {

      let result = change(value.split(''));
      result.sort(compareRandom);
      result = result.join('$');
      return result;
    }

    function compareRandom(a, b) {
      return a - b;
    }

    function change(value) {
      let result = [];
      for (let i = 0; i < value.length; ++i) {
        result[i] = 1;
        if (value[i] == 'a' || value[i] == 'A')
          result[i] = 2350;
        if (value[i] == 'b' || value[i] == 'B')
          result[i] = 16541;
        if (value[i] == 'c' || value[i] == 'C')
          result[i] = 558;
        if (value[i] == 'd' || value[i] == 'D')
          result[i] = 712;
        if (value[i] == 'e' || value[i] == 'E')
          result[i] = -26451;
        if (value[i] == 'f' || value[i] == 'F')
          result[i] = -4098;
        if (value[i] == 'g' || value[i] == 'G')
          result[i] = 3456;
        if (value[i] == 'h' || value[i] == 'H')
          result[i] = -335;
        if (value[i] == 'i' || value[i] == 'I')
          result[i] = 1234325;
        if (value[i] == 'j' || value[i] == 'J')
          result[i] = 7403665;
        if (value[i] == 'k' || value[i] == 'K')
          result[i] = -23459;
        if (value[i] == 'l' || value[i] == 'L')
          result[i] = -8751;
        if (value[i] == 'm' || value[i] == 'M')
          result[i] = -956;
        if (value[i] == 'n' || value[i] == 'N')
          result[i] = 9234;
        if (value[i] == 'o' || value[i] == 'O')
          result[i] = 1623;
        if (value[i] == 'p' || value[i] == 'P')
          result[i] = -356125356;
        if (value[i] == 'q' || value[i] == 'Q')
          result[i] = 2652362;
        if (value[i] == 'r' || value[i] == 'R')
          result[i] = 15485736;
        if (value[i] == 's' || value[i] == 'S')
          result[i] = -5812134623;
        if (value[i] == 't' || value[i] == 'T')
          result[i] = 306786;
        if (value[i] == 'u' || value[i] == 'U')
          result[i] = 4637;
        if (value[i] == 'v' || value[i] == 'V')
          result[i] = -5635;
        if (value[i] == 'x' || value[i] == 'X')
          result[i] = -68;
        if (value[i] == 'y' || value[i] == 'Y')
          result[i] = 77856;
        if (value[i] == 'z' || value[i] == 'Z')
          result[i] = -7567563767;
        if (value[i] == 'w' || value[i] == 'W')
          result[i] = 5967808;
        if (value[i] == '0')
          result[i] = -1;
        if (value[i] == '1')
          result[i] = -9;
        if (value[i] == '2')
          result[i] = -6;
        if (value[i] == '3')
          result[i] = -5;
        if (value[i] == '4')
          result[i] = -4;
        if (value[i] == '5')
          result[i] = -8;
        if (value[i] == '6')
          result[i] = -2;
        if (value[i] == '7')
          result[i] = -3;
        if (value[i] == '8')
          result[i] = -7;
        if (value[i] == '9')
          result[i] = 0;
      }
      return result;
    }
  }
})();
