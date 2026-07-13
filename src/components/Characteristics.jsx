import "./Characteristics.css";

function Characteristics() {
    const car = {
        brand: "BMW",
        model: "X5",
        year: 2022,
        body: "SUV",
        engine: "Бензин 3.0",
        transmission: "Автоматична",
        drive: "Повний",
        power: "340 к.с.",
        seats: 5,
        color: "Чорний"
    };

    return (
        <section className="characteristics">
            <h2>Характеристики автомобіля</h2>

            <div className="characteristics-grid">

                <div className="item">
                    <span>Марка</span>
                    <strong>{car.brand}</strong>
                </div>

                <div className="item">
                    <span>Модель</span>
                    <strong>{car.model}</strong>
                </div>

                <div className="item">
                    <span>Рік випуску</span>
                    <strong>{car.year}</strong>
                </div>

                <div className="item">
                    <span>Тип кузова</span>
                    <strong>{car.body}</strong>
                </div>

                <div className="item">
                    <span>Двигун</span>
                    <strong>{car.engine}</strong>
                </div>

                <div className="item">
                    <span>Коробка передач</span>
                    <strong>{car.transmission}</strong>
                </div>

                <div className="item">
                    <span>Привід</span>
                    <strong>{car.drive}</strong>
                </div>

                <div className="item">
                    <span>Потужність</span>
                    <strong>{car.power}</strong>
                </div>

                <div className="item">
                    <span>Кількість місць</span>
                    <strong>{car.seats}</strong>
                </div>

                <div className="item">
                    <span>Колір</span>
                    <strong>{car.color}</strong>
                </div>

            </div>
        </section>
    );
}

export default Characteristics;
