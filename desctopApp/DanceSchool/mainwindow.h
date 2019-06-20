#ifndef MAINWINDOW_H
#define MAINWINDOW_H

#include <QMainWindow>
#include "chttpcontroller.h"
#include "cjsonparser.h"
#include "cjsondata.h"
#include <QDateTime>
#include <QTime>
#include <QSettings>

namespace Ui {
class MainWindow;
}

class MainWindow : public QMainWindow
{
	Q_OBJECT

public:
	explicit MainWindow(QWidget *parent = nullptr);
	~MainWindow();

private slots:
	void on_addCourse_2_clicked();

	void on_courseSettings_currentChanged(int index);

	void on_courseUpdateId_currentIndexChanged(const QString &arg1);

	void on_addCourse_3_clicked();

	void on_btnRemoveCourse_clicked();

	void on_styleAddButton_clicked();

	void on_styleUpdateButton_clicked();

	void on_styleDeleteButton_clicked();

	void on_lessonAddbutton_clicked();

	void on_trainerAddButton_clicked();

	void on_trainerUpdateButton_clicked();

	void on_trainerDeleteButton_clicked();

	void on_newsAddButton_clicked();

	void on_newsUpdateButton_clicked();

	void on_newsDeleteButton_clicked();

	void on_roomsAddButton_clicked();

	void on_roomDeleteButton_clicked();

	void on_roomsSettings_currentChanged(int index);

	void on_tabWidget_currentChanged(int index);

	void on_trainerUpdateName_currentIndexChanged(int index);

	void on_newsUpdateNews_currentIndexChanged(const QString &arg1);

	void on_lessonUpdateCourse_currentIndexChanged(const QString &arg1);

private:
	Ui::MainWindow *ui;
	QSettings settings;
};

#endif // MAINWINDOW_H
