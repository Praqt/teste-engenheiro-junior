import ComboBox from "@/Components/ComboBox";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { StatusEnum } from "@/lib/enums/StatusEnum";
import { Head, useForm } from "@inertiajs/react";
import axios from "axios";
import { useEffect, useState } from "react";

export default function Form({ auth, order }) {
    const {data, setData, post, put, processing, errors} = useForm({
        status: order ? order.status : "",
        total_price: order ? order.total_price : "",
    });
    
    const [products, setProducts] = useState(null); 
    const [clients, setClients] = useState(null);
    const [selectedProducts, setSelectedProducts] = useState(new Set());
    const [selectedClient, setSelectedClient] = useState(null);
    
    
    useEffect(() => {
        if(products === null) {
            axios
                .get("http://localhost/api/products", {
                    headers: { Accept: "application/json" }
                })
                .then(res => setProducts(res.data))
                .catch(e => console.log(e));
        }
        if(clients === null) {
            axios
                .get("http://localhost/api/clients", {
                    headers: { Accept: "application/json" }
                })
                .then(res => setClients(res.data))
                .catch(e => console.log(e))
        }
        if(selectedClient === null && order) {
            axios
                .get(`http://localhost/api/orders/${order.id}/client`, {
                    headers: { Accept: "application/json" }
                })
                .then(res => {
                    if(res.status !== 404)
                        setSelectedClient(res.data.data)
                })
                .catch(e => console.log(e))
        }
    }, [])

    useEffect(() => {
        if(selectedProducts.size > 0) {
            let new_total_price = 0;
            Array.from(selectedProducts).map(product => {
                new_total_price = product.price + new_total_price;
            });
            setData(data => ({ ...data, total_price: new_total_price }));
        }
        else if(selectedProducts.size === 0 && order === null) {
            setData(data => ({ ...data, total_price: 0 }));
        }
    }, [selectedProducts])
    
    function handleSubmit(e) {
        e.preventDefault();

        if (order === undefined)
            post(route("dashboard.orders.store", selectedClient.id));
        else
            put(route("dashboard.orders.update", order.id));
    }
    
    function handleProductSelection(item) {
        setSelectedProducts(prev => new Set(prev.add(item)));
    }
    
    function handleClientSelection(item) {
        setSelectedClient(item);
    }
    
    function handleProductDelete(e, item) {
        e.preventDefault();

        setSelectedProducts(prev => {
            prev.delete(item);
            return new Set(prev);
        })
    }

    return (
        <AuthenticatedLayout user={auth.user}
            header={
                <div className="flex justify-between">
                    <h2 className="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">{order ? "Alterar Pedido" : "Novo Pedido"}</h2>
                </div>
            }
        >
            <Head title="Pedidos" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white dark:bg-gray-800 w-1/2 mx-auto overflow-hidden shadow-sm sm:rounded-lg">
                        {clients && products ? 
                            <form onSubmit={handleSubmit} className="flex flex-col gap-y-5 py-10 items-center">
                                <label className="flex flex-col">
                                    <span className="text-gray-200">Preço Total</span>
                                    <input type="text" placeholder="" value={(data.total_price / 100.0).toFixed(2)}
                                        disabled={true}
                                        className="form-input rounded-md shadow-sm opacity-80" />

                                    {errors.total_price !== undefined && <span className="text-red-500">{errors.total_price}</span>}
                                </label>

                                <label className="flex flex-col z-50">
                                    <span className="text-gray-200">Cliente</span>
                                    <ComboBox items={clients} handler={handleClientSelection} label={selectedClient ? selectedClient.name : "Selecione o Cliente"} />
                                </label>

                                <label className="flex flex-col z-40">
                                    <span className="text-gray-200">Produtos</span>
                                    <ComboBox items={products} handler={handleProductSelection} label="Selecione os Produtos..." />
                                </label>
                                {selectedProducts.size > 0 && (
                                    <div className="p-3 w-72">
                                        <div className="font-bold rounded-t-lg p-5 bg-red-500 w-full">Produtos Selecionados</div>
                                        <ul className="flex flex-col gap-y-1 py-4 px-3 bg-gray-100 rounded-b-lg">
                                            {Array.from(selectedProducts).map((product) => (
                                                <li key={product.id} className="flex justify-between">
                                                    <div>
                                                        <span>{product.name}</span>
                                                        <span>{" - R$" + (product.price / 100).toFixed(2)}</span>
                                                    </div>
                                                    <button onClick={(e) => handleProductDelete(e, product)} className="text-red-200 bg-red-500 px-2 rounded-full">x</button>
                                                </li>
                                            ))}
                                        </ul>
                                    </div>
                                )}

                                <label className="flex flex-col w-60">
                                    <span className="text-gray-200 py-2">Status</span>
                                    <ul className="flex flex-col w-full items-start p-3 text-gray-800 bg-gray-200 rounded-xl gap-y-5">
                                        {StatusEnum.map((option, i) => (
                                            <li key={i} className="flex gap-x-2 items-center">
                                                <span className="">{option.label}</span>
                                                <input type="radio" value={option.value}
                                                    name="status"
                                                    checked={order && order.status === option.value}
                                                    onChange={() => setData(data => ({ ...data, status: option.value }))}
                                                    className="form-radio rounded-md shadow-sm" />
                                            </li>
                                        ))
                                        }
                                    </ul>
                                    {errors.status !== undefined && <span className="text-red-500">{errors.status}</span>}
                                </label>

                                <button type="submit" disabled={processing}
                                    className="text-gray-100 mt-5 bg-red-900 px-5 py-2.5 font-bold rounded-lg">
                                    Enviar
                                </button>
                            </form>
                            :
                            <div className="p-5 text-white">Não há clientes e/ou produtos para realizar um pedido!</div>
                        }
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    )
}