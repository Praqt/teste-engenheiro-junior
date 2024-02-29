import React, { useState, useEffect } from "react";
import axios from "axios";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import { Table } from "rsuite";
import "rsuite/Table/styles/index.css";
import { FontAwesomeIcon } from "@fortawesome/react-fontawesome";
import { faEdit, faTrash } from "@fortawesome/free-solid-svg-icons";

const { Column, HeaderCell, Cell } = Table;

export default function List({ auth }) {
    const [products, setProducts] = useState([]);

    const IconButton = ({ icon, onClick }) => {
        return (
            <button className="icon-button" onClick={onClick}>
                <FontAwesomeIcon icon={icon} />
            </button>
        );
    };

    const CurrencyCell = ({ rowData, dataKey, ...props }) => {
        const formattedPrice = new Intl.NumberFormat("pt-BR", {
            style: "currency",
            currency: "BRL",
        }).format(rowData[dataKey]);

        return <Cell {...props}>{formattedPrice}</Cell>;
    };


    const handleDelete = async (orderId) => {
        try {
            const response = await axios.delete(
                `/api/delete/products/${orderId}`,
                {
                    headers: {
                        "Content-Type": "application/json",
                    },
                }
            );

            if (response.status === 200) {
                console.log("Product deleted successfully");
                window.location.reload();
            } else {
                console.error("Failed to delete product");
            }
        } catch (error) {
            console.error("Error deleting product:", error);
        }
    };

    useEffect(() => {
        axios
            .get("/api/products")
            .then((response) => {
                setProducts(response.data);
            })
            .catch((error) => {
                console.error("Error fetching products:", error);
                setError(error);
            });
    }, []);

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Produtos
                </h2>
            }
        >
            <Head title="Products" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <Table
                        height={600}
                        data={Object.values(products)}
                        onRowClick={(rowData) => {
                            console.log(rowData);
                        }}
                    >
                        <Column width={150} fixed>
                            <HeaderCell>Nome</HeaderCell>
                            <Cell dataKey="name" />
                        </Column>

                        <Column width={150}>
                            <HeaderCell>Descrição</HeaderCell>
                            <Cell dataKey="description" />
                        </Column>

                        <Column width={150}>
                            <HeaderCell>Preço</HeaderCell>
                            <CurrencyCell dataKey="price" />
                        </Column>
                        <Column width={40} fixed="right">
                            <HeaderCell></HeaderCell>
                            <Cell style={{ padding: "6px" }}>
                                {(rowData) => (
                                    <IconButton
                                        icon={faEdit}
                                        href={route("product.edit", rowData.uuid)}
                                    />
                                )}
                            </Cell>
                        </Column>

                        <Column width={40} fixed="right">
                            <HeaderCell></HeaderCell>
                            <Cell style={{ padding: "6px" }}>
                                {(rowData) => (
                                    <IconButton
                                        icon={faTrash}
                                        onClick={() =>
                                            handleDelete(rowData.uuid)
                                        }
                                    />
                                )}
                            </Cell>
                        </Column>
                    </Table>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
