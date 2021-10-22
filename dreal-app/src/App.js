import React from "react";
import ReactDOM from "react-dom";

class App extends React.Component {
    render() {
        const title = "Application de visualisation et de localisation des stocks";
        //const ......
        return (
            <div>
                <h1>{title}</h1>
            </div>
        )
    }
}

const rootElement = document.getElementById('root');
ReactDOM.render(<App />, rootElement);

export default App;