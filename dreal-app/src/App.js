import React, { useRef, useEffect } from "react";
import ReactDOM from "react-dom";

const Canvas = props => {
    const canvasRef = useRef(null)

    useEffect(() => {
        const canvas = canvasRef.current
        const context = canvas.getContext('2d')
        let width = context.canvas.width - 10;
        let height = context.canvas.height - 10;
        context.fillStyle = '#000000'
        context.fillRect(0, 0, width, height)
        context.clearRect(5, 5, width, height);
    }, [])

    return <div>
        <h1>Visualisation et localisation des stocks</h1>
        <canvas ref={canvasRef} {...props}/>
        </div>
}

const rootElement = document.getElementById('root');
ReactDOM.render(<Canvas />, rootElement);

export default Canvas