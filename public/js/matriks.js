document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('matrix-form');
    const matrix1RowsInput = document.getElementById('matrix1-rows');
    const matrix1ColsInput = document.getElementById('matrix1-cols');
    const matrix2RowsInput = document.getElementById('matrix2-rows');
    const matrix2ColsInput = document.getElementById('matrix2-cols');
    const generateButton = document.getElementById('generate-matrices');
    const matricesContainer = document.getElementById('matrices-container');
    const resultContainer = document.getElementById('result-container');

    generateButton.addEventListener('click', function() {
        const matrix1Rows = parseInt(matrix1RowsInput.value, 10);
        const matrix1Cols = parseInt(matrix1ColsInput.value, 10);
        const matrix2Rows = parseInt(matrix2RowsInput.value, 10);
        const matrix2Cols = parseInt(matrix2ColsInput.value, 10);
        if (matrix1Rows > 0 && matrix1Cols > 0 && matrix2Rows > 0 && matrix2Cols > 0) {
            generateMatrices(matrix1Rows, matrix1Cols, matrix2Rows, matrix2Cols);
        }
    });

    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const operation = document.querySelector('input[name="operation"]:checked').value;
        const matrix1Rows = parseInt(matrix1RowsInput.value, 10);
        const matrix1Cols = parseInt(matrix1ColsInput.value, 10);
        const matrix2Rows = parseInt(matrix2RowsInput.value, 10);
        const matrix2Cols = parseInt(matrix2ColsInput.value, 10);
        const matrix1 = getMatrixValues('matrix1', matrix1Rows, matrix1Cols);
        const matrix2 = getMatrixValues('matrix2', matrix2Rows, matrix2Cols);
        let result;

        if (operation === 'add' || operation === 'subtract') {
            if (matrix1Rows !== matrix2Rows || matrix1Cols !== matrix2Cols) {
                alert('Untuk pertambahan dan pengurangan, ordo kedua matriks harus sama');
                return;
            }
            result = operation === 'add' ? addMatrices(matrix1, matrix2) : subtractMatrices(matrix1,
                matrix2);
        } else if (operation === 'multiply') {
            if (matrix1Cols !== matrix2Rows) {
                alert(
                    'Syarat perkalian tidak terpenuhi, jumlah kolom matriks pertama harus sama dengan jumlah baris matriks kedua'
                    );
                return;
            }
            result = multiplyMatrices(matrix1, matrix2);
        } else if (operation === 'transpose1') {
            result = transposeMatrix(matrix1);
        } else if (operation === 'transpose2') {
            result = transposeMatrix(matrix2);
        } else if (operation === 'determinant1') {
            if (matrix1Rows !== matrix1Cols) {
                alert('Matriks 1 harus memiliki jumlah baris dan kolom yang sama untuk dilakukan determinan');
                return;
            }
            result = calculateDeterminant(matrix1);
        } else if (operation === 'determinant2') {
            if (matrix2Rows !== matrix2Cols) {
                alert('Matriks 2 harus memiliki jumlah baris dan kolom yang sama untuk dilakukan determinan');
                return;
            }
            result = calculateDeterminant(matrix2);
        }

        displayResult(result);
    });

    function generateMatrices(matrix1Rows, matrix1Cols, matrix2Rows, matrix2Cols) {
        matricesContainer.innerHTML = '';
        resultContainer.innerHTML = '';
        createMatrixInput('matrix1', matrix1Rows, matrix1Cols);
        createMatrixInput('matrix2', matrix2Rows, matrix2Cols);
    }

    function createMatrixInput(id, rows, cols) {
        const matrixDiv = document.createElement('div');
        matrixDiv.classList.add('mb-4');
        matrixDiv.innerHTML = `<h3 class="text-lg font-semibold mb-2">Matrix ${id.slice(-1)}</h3>`;
        for (let i = 0; i < rows; i++) {
            for (let j = 0; j < cols; j++) {
                matrixDiv.innerHTML +=
                    `<input type="number" id="${id}-${i}-${j}" class="border border-black rounded px-2 py-1 m-1 w-16">`;
            }
            matrixDiv.innerHTML += '<br>';
        }
        matricesContainer.appendChild(matrixDiv);
    }

    function getMatrixValues(id, rows, cols) {
        const matrix = [];
        for (let i = 0; i < rows; i++) {
            const row = [];
            for (let j = 0; j < cols; j++) {
                row.push(parseFloat(document.getElementById(`${id}-${i}-${j}`).value) || 0);
            }
            matrix.push(row);
        }
        return matrix;
    }

    function addMatrices(matrix1, matrix2) {
        return matrix1.map((row, i) => row.map((val, j) => val + matrix2[i][j]));
    }

    function subtractMatrices(matrix1, matrix2) {
        return matrix1.map((row, i) => row.map((val, j) => val - matrix2[i][j]));
    }

    function multiplyMatrices(matrix1, matrix2) {
        const result = Array.from({
            length: matrix1.length
        }, () => Array(matrix2[0].length).fill(0));
        for (let i = 0; i < matrix1.length; i++) {
            for (let j = 0; j < matrix2[0].length; j++) {
                for (let k = 0; k < matrix1[0].length; k++) {
                    result[i][j] += matrix1[i][k] * matrix2[k][j];
                }
            }
        }
        return result;
    }

    function transposeMatrix(matrix) {
        return matrix[0].map((_, colIndex) => matrix.map(row => row[colIndex]));
    }

    function calculateDeterminant(matrix) {
        if (matrix.length === 2) {
            return matrix[0][0] * matrix[1][1] - matrix[0][1] * matrix[1][0];
        }

        let determinant = 0;
        for (let i = 0; i < matrix.length; i++) {
            determinant += (i % 2 === 0 ? 1 : -1) * matrix[0][i] * calculateDeterminant(minor(matrix, 0,
                i));
        }
        return determinant;
    }

    function minor(matrix, row, col) {
        return matrix.reduce((result, current, rowIndex) => {
            if (rowIndex !== row) {
                const newRow = current.filter((_, colIndex) => colIndex !== col);
                result.push(newRow);
            }
            return result;
        }, []);
    }

    function displayResult(result) {
        if (typeof result === 'number') {
            resultContainer.innerHTML = `<h3 class="text-lg font-semibold mb-2">Jawaban: ${result}</h3>`;
        } else {
            resultContainer.innerHTML = '<h3 class="text-lg font-semibold mb-2">Jawaban</h3>';
            result.forEach(row => {
                row.forEach(value => {
                    resultContainer.innerHTML +=
                        `<span class="border border-black rounded px-2 py-1 m-1 w-16 inline-block text-center">${value}</span>`;
                });
                resultContainer.innerHTML += '<br>';
            });
        }
    }
});
