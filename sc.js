function diagonalDifference(arr) {
    // Write your code here
    let a = 0
    let b = 0
    for(let i = 0; i < arr.length; i++) {
            a = arr[i]
        for(let j = 0; j < arr.length; j++) {
            b = arr[j]
        }
    }
    return [a, b]

}

console.log(diagonalDifference([
    [11,2,4],
    [4,5,6],
    [10,8,-12]
]))