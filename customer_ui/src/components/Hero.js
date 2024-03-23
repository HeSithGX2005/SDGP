import "./HeroStyle.css";

function Hero(props) {
  return (
    <>
      <div className={props.cName}>
        <div className="hero-images">
          <img alt="HerpImg" src={props.heroImg} />
          <img className="helmet" alt="" src={props.helmetimg} />
        </div>

        <div className="hero-text">
          <h1>{props.title}</h1>
          <h2>{props.title2}</h2>
          <h3>{props.title3}</h3>
          <div className="title-line">
            <h4>{props.title4}</h4>
            {props.showP1 && <p className={props.pClass1}>Supervisors can monitor employees' work remotely.</p>}
          </div>
          <div className="title-line">
            <h5>{props.title5}</h5>
            {props.showP2 && <p className={props.pClass2}>Warns about gas leaks to workers ans supervisors nearby.</p>}
            {props.showP3 && <p className={props.pClass3}>Shows the Salary & Working hours of a Worker.</p>}
            {props.showP4 && <p className={props.pClass4}>And more.</p>}
          </div>
          <div className="title-line">
            <h6>{props.title6}</h6>
          </div>
          <a href={props.url} className={props.btnClass}>
            {props.btnName}
          </a>
        </div>
      </div>
    </>
  );
}

export default Hero;
