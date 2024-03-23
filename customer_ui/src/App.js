import './style.css';
import { Route, Routes } from 'react-router-dom';
import Home from "./routes/Home";
import Product from "./routes/Product";
import Contact from "./routes/Contact";

function App() {
  return (
    <div className="App">
      <Routes>
        <Route path="/" element={<Home/>}/>
        <Route path="/ourProduct" element={<Product/>}/>
        <Route path="/contactUs" element={<Contact/>}/>
      </Routes>
    </div>
  );
}

export default App;