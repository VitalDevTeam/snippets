/* sample cubic beziers */
linear = [0.250, 0.250, 0.750, 0.750];
ease = [0.250, 0.100, 0.250, 1.000];
easeIn = [0.420, 0.000, 1.000, 1.000];
easeOut = [0.000, 0.000, 0.580, 1.000];
easeInOut = [0.420, 0.000, 0.580, 1.000];

function reverseCubicBezier(cubicBezier) {
    return [
        1 - cubicBezier[2],
        1 - cubicBezier[3],
        1 - cubicBezier[0],
        1 - cubicBezier[1]
    ];
}

console.log(reverseCubicBezier(linear));