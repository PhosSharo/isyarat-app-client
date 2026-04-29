"""Post biodata records sequentially to a remote Laravel endpoint."""
from __future__ import annotations

import sys
import time
from typing import Dict, List

import requests

ENDPOINT = "https://orthomorphic-providential-shaina.ngrok-free.dev/public/api/biodata"

EXISTING_RECORDS: List[Dict[str, str]] = [
    {
        "nama": "Pria Solo",
        "npm": "011230041",
        "prodi": "informatika",
        "ipk": "4",
        "semester": "6",
    },
    {
        "nama": "Pria Sawit",
        "npm": "011230045",
        "prodi": "informatika",
        "ipk": "4",
        "semester": "6",
    },
    {
        "nama": "Zaky",
        "npm": "011230021",
        "prodi": "informatika",
        "ipk": "4",
        "semester": "6",
    },
]

DUMMY_RECORDS: List[Dict[str, str]] = [
    {
        "nama": "Pria Matang",
        "npm": "011230099",
        "prodi": "informatika",
        "ipk": "3.8",
        "semester": "4",
    },
    {
        "nama": "Wanita Janggal",
        "npm": "011230100",
        "prodi": "sistem informasi",
        "ipk": "3.6",
        "semester": "5",
    },
]

PAYLOADS: List[Dict[str, str]] = EXISTING_RECORDS + DUMMY_RECORDS


def post_record(record: Dict[str, str], index: int) -> None:
    print(f"[{index + 1}/{len(PAYLOADS)}] Posting {record['nama']} ...", end=" ")
    try:
        response = requests.post(ENDPOINT, json=record, timeout=15)
        response.raise_for_status()
        print(f"OK (status {response.status_code})")
    except requests.RequestException as exc:  # brief failure summary helps debugging
        print("FAILED")
        print(f"    Error: {exc}")
        sys.exit(1)


def main() -> None:
    print(f"Sending {len(PAYLOADS)} records to {ENDPOINT}\n")
    for idx, record in enumerate(PAYLOADS):
        post_record(record, idx)
        time.sleep(0.5)
    print("\nAll records posted successfully.")


if __name__ == "__main__":  # script entry point
    main()
