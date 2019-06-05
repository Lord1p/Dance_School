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
            result[i] = -5;
            if (value[i] == 'a' || value[i] == 'A')
                result[i] = 0;
            if (value[i] == 'b' || value[i] == 'B')
                result[i] = -1;
            if (value[i] == 'c' || value[i] == 'C')
                result[i] = -5;
            if (value[i] == 'd' || value[i] == 'D')
                result[i] = 7;
            if (value[i] == 'e' || value[i] == 'E')
                result[i] = 9;
            if (value[i] == 'f' || value[i] == 'F')
                result[i] = 0;
            if (value[i] == 'g' || value[i] == 'G')
                result[i] = -3;
            if (value[i] == 'h' || value[i] == 'H')
                result[i] = 120;
            if (value[i] == 'i' || value[i] == 'I')
                result[i] = 5;
            if (value[i] == 'j' || value[i] == 'J')
                result[i] = 0;
            if (value[i] == 'k' || value[i] == 'K')
                result[i] = -9;
            if (value[i] == 'l' || value[i] == 'L')
                result[i] = -19;
            if (value[i] == 'm' || value[i] == 'M')
                result[i] = -59;
            if (value[i] == 'n' || value[i] == 'N')
                result[i] = 9;
            if (value[i] == 'o' || value[i] == 'O')
                result[i] = 1;
            if (value[i] == 'p' || value[i] == 'P')
                result[i] = -1;
            if (value[i] == 'q' || value[i] == 'Q')
                result[i] = 2;
            if (value[i] == 'r' || value[i] == 'R')
                result[i] = 8;
            if (value[i] == 's' || value[i] == 'S')
                result[i] = -8;
            if (value[i] == 't' || value[i] == 'T')
                result[i] = 3;
            if (value[i] == 'u' || value[i] == 'U')
                result[i] = 84;
            if (value[i] == 'v' || value[i] == 'V')
                result[i] = 54;
            if (value[i] == 'x' || value[i] == 'X')
                result[i] = 45;
            if (value[i] == 'y' || value[i] == 'Y')
                result[i] = 87;
            if (value[i] == 'z' || value[i] == 'Z')
                result[i] = 43;
            if (value[i] == 'w' || value[i] == 'W')
                result[i] = 8;
        }
        return result;
    }
}

const e = new Encryptor();
console.log(e.enctypt(process.argv[2]));